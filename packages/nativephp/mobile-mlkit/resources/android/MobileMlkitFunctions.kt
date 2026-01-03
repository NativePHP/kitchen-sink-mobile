package com.nativephp.plugins.mobilemlkit

import android.content.Context
import android.graphics.Bitmap
import android.graphics.BitmapFactory
import android.util.Log
import androidx.camera.core.*
import androidx.camera.lifecycle.ProcessCameraProvider
import androidx.core.content.ContextCompat
import androidx.fragment.app.FragmentActivity
import com.nativephp.mobile.bridge.BridgeFunction
import com.nativephp.mobile.bridge.BridgeResponse
import com.nativephp.mobile.bridge.LaravelBridge
import org.tensorflow.lite.Interpreter
import org.tensorflow.lite.gpu.GpuDelegate
import java.io.FileInputStream
import java.nio.ByteBuffer
import java.nio.ByteOrder
import java.nio.MappedByteBuffer
import java.nio.channels.FileChannel
import java.util.concurrent.ExecutorService
import java.util.concurrent.Executors

/**
 * MobileMlkit Bridge Functions
 * Provides TensorFlow Lite inference for shark teeth detection
 * Namespace: "MobileMlkit.*"
 */
object MobileMlkitFunctions {

    private const val TAG = "MobileMlkit"

    // Shared state
    private var interpreter: Interpreter? = null
    private var gpuDelegate: GpuDelegate? = null
    private var isModelLoaded = false
    private var isDetecting = false
    private var modelInputWidth = 224
    private var modelInputHeight = 224
    private var labels: List<String> = emptyList()
    private var cameraExecutor: ExecutorService? = null
    private var imageAnalyzer: ImageAnalysis? = null
    private var cameraProvider: ProcessCameraProvider? = null

    /**
     * Load a TensorFlow Lite model for inference
     * Parameters:
     *   - modelPath: String - Path to the .tflite model file (relative to assets)
     *   - labelsPath: String? - Optional path to labels.txt file
     *   - useGpu: Boolean - Whether to use GPU acceleration (default: true)
     *   - inputWidth: Int - Model input width (default: 224)
     *   - inputHeight: Int - Model input height (default: 224)
     * Returns:
     *   - loaded: Boolean - Whether model was loaded successfully
     *   - inputWidth: Int - Model input width
     *   - inputHeight: Int - Model input height
     *   - labelsCount: Int - Number of labels loaded
     */
    class LoadModel(private val context: Context) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            Log.d(TAG, "📦 Loading TensorFlow Lite model...")

            val modelPath = parameters["modelPath"] as? String
                ?: return BridgeResponse.error("Model path is required")

            val labelsPath = parameters["labelsPath"] as? String
            val useGpu = parameters["useGpu"] as? Boolean ?: true
            modelInputWidth = (parameters["inputWidth"] as? Number)?.toInt() ?: 224
            modelInputHeight = (parameters["inputHeight"] as? Number)?.toInt() ?: 224

            return try {
                // Close existing interpreter if any
                closeInterpreter()

                // Load model from assets
                val modelBuffer = loadModelFile(context, modelPath)

                // Configure interpreter options
                val options = Interpreter.Options()

                if (useGpu) {
                    try {
                        gpuDelegate = GpuDelegate()
                        options.addDelegate(gpuDelegate)
                        Log.d(TAG, "✅ GPU delegate enabled")
                    } catch (e: Exception) {
                        Log.w(TAG, "⚠️ GPU delegate not available, falling back to CPU: ${e.message}")
                    }
                }

                options.setNumThreads(4)

                // Create interpreter
                interpreter = Interpreter(modelBuffer, options)
                isModelLoaded = true

                // Load labels if provided
                if (labelsPath != null) {
                    labels = loadLabels(context, labelsPath)
                    Log.d(TAG, "✅ Loaded ${labels.size} labels")
                }

                Log.d(TAG, "✅ Model loaded successfully: $modelPath")

                // Dispatch event
                LaravelBridge.dispatchEvent(
                    "NativePHP\\MobileMlkit\\Events\\ModelLoaded",
                    mapOf(
                        "modelPath" to modelPath,
                        "gpuEnabled" to (gpuDelegate != null),
                        "inputWidth" to modelInputWidth,
                        "inputHeight" to modelInputHeight
                    )
                )

                BridgeResponse.success(mapOf(
                    "loaded" to true,
                    "inputWidth" to modelInputWidth,
                    "inputHeight" to modelInputHeight,
                    "labelsCount" to labels.size,
                    "gpuEnabled" to (gpuDelegate != null)
                ))
            } catch (e: Exception) {
                Log.e(TAG, "❌ Failed to load model: ${e.message}", e)
                BridgeResponse.error("Failed to load model: ${e.message}")
            }
        }

        private fun loadModelFile(context: Context, modelPath: String): MappedByteBuffer {
            val assetFileDescriptor = context.assets.openFd(modelPath)
            val inputStream = FileInputStream(assetFileDescriptor.fileDescriptor)
            val fileChannel = inputStream.channel
            val startOffset = assetFileDescriptor.startOffset
            val declaredLength = assetFileDescriptor.declaredLength
            return fileChannel.map(FileChannel.MapMode.READ_ONLY, startOffset, declaredLength)
        }

        private fun loadLabels(context: Context, labelsPath: String): List<String> {
            return try {
                context.assets.open(labelsPath).bufferedReader().readLines()
            } catch (e: Exception) {
                Log.w(TAG, "⚠️ Could not load labels: ${e.message}")
                emptyList()
            }
        }
    }

    /**
     * Start real-time detection from camera feed
     * Parameters:
     *   - confidenceThreshold: Float - Minimum confidence for detection (default: 0.5)
     *   - maxResults: Int - Maximum number of results to return (default: 5)
     * Returns:
     *   - started: Boolean - Whether detection was started
     */
    class DetectFromCamera(private val activity: FragmentActivity) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            Log.d(TAG, "📷 Starting camera detection...")

            if (!isModelLoaded || interpreter == null) {
                return BridgeResponse.error("Model not loaded. Call LoadModel first.")
            }

            if (isDetecting) {
                return BridgeResponse.error("Detection already in progress")
            }

            val confidenceThreshold = (parameters["confidenceThreshold"] as? Number)?.toFloat() ?: 0.5f
            val maxResults = (parameters["maxResults"] as? Number)?.toInt() ?: 5

            return try {
                cameraExecutor = Executors.newSingleThreadExecutor()

                val cameraProviderFuture = ProcessCameraProvider.getInstance(activity)
                cameraProviderFuture.addListener({
                    cameraProvider = cameraProviderFuture.get()

                    // Set up image analysis
                    imageAnalyzer = ImageAnalysis.Builder()
                        .setTargetResolution(android.util.Size(640, 480))
                        .setBackpressureStrategy(ImageAnalysis.STRATEGY_KEEP_ONLY_LATEST)
                        .build()
                        .also {
                            it.setAnalyzer(cameraExecutor!!) { imageProxy ->
                                processImage(imageProxy, confidenceThreshold, maxResults)
                            }
                        }

                    // Select back camera
                    val cameraSelector = CameraSelector.DEFAULT_BACK_CAMERA

                    try {
                        cameraProvider?.unbindAll()
                        cameraProvider?.bindToLifecycle(
                            activity,
                            cameraSelector,
                            imageAnalyzer
                        )
                        isDetecting = true
                        Log.d(TAG, "✅ Camera detection started")
                    } catch (e: Exception) {
                        Log.e(TAG, "❌ Camera binding failed: ${e.message}", e)
                    }
                }, ContextCompat.getMainExecutor(activity))

                BridgeResponse.success(mapOf(
                    "started" to true,
                    "confidenceThreshold" to confidenceThreshold,
                    "maxResults" to maxResults
                ))
            } catch (e: Exception) {
                Log.e(TAG, "❌ Failed to start camera detection: ${e.message}", e)
                BridgeResponse.error("Failed to start camera detection: ${e.message}")
            }
        }

        @androidx.camera.core.ExperimentalGetImage
        private fun processImage(imageProxy: ImageProxy, confidenceThreshold: Float, maxResults: Int) {
            val startTime = System.currentTimeMillis()

            try {
                val bitmap = imageProxy.toBitmap()
                if (bitmap != null) {
                    val detections = runInference(bitmap, confidenceThreshold, maxResults)
                    val processingTime = System.currentTimeMillis() - startTime

                    if (detections.isNotEmpty()) {
                        // Dispatch detection event for each high-confidence detection
                        detections.forEach { detection ->
                            LaravelBridge.dispatchEvent(
                                "NativePHP\\MobileMlkit\\Events\\SharkToothDetected",
                                mapOf(
                                    "label" to detection["label"],
                                    "confidence" to detection["confidence"],
                                    "boundingBox" to detection["boundingBox"]
                                )
                            )
                        }

                        // Dispatch completion event
                        LaravelBridge.dispatchEvent(
                            "NativePHP\\MobileMlkit\\Events\\DetectionCompleted",
                            mapOf(
                                "detections" to detections,
                                "processingTimeMs" to processingTime
                            )
                        )
                    }
                }
            } catch (e: Exception) {
                Log.e(TAG, "❌ Error processing image: ${e.message}", e)
            } finally {
                imageProxy.close()
            }
        }
    }

    /**
     * Run detection on a static image
     * Parameters:
     *   - imagePath: String - Path to the image file
     *   - confidenceThreshold: Float - Minimum confidence (default: 0.5)
     *   - maxResults: Int - Maximum results (default: 5)
     * Returns:
     *   - detections: Array - List of detected objects with labels and confidence
     *   - processingTimeMs: Long - Processing time in milliseconds
     */
    class DetectFromImage(private val context: Context) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            Log.d(TAG, "🖼️ Running detection on image...")

            if (!isModelLoaded || interpreter == null) {
                return BridgeResponse.error("Model not loaded. Call LoadModel first.")
            }

            val imagePath = parameters["imagePath"] as? String
                ?: return BridgeResponse.error("Image path is required")

            val confidenceThreshold = (parameters["confidenceThreshold"] as? Number)?.toFloat() ?: 0.5f
            val maxResults = (parameters["maxResults"] as? Number)?.toInt() ?: 5

            return try {
                val startTime = System.currentTimeMillis()

                // Load bitmap
                val bitmap = BitmapFactory.decodeFile(imagePath)
                    ?: return BridgeResponse.error("Failed to load image: $imagePath")

                // Run inference
                val detections = runInference(bitmap, confidenceThreshold, maxResults)
                val processingTime = System.currentTimeMillis() - startTime

                Log.d(TAG, "✅ Detection complete: ${detections.size} results in ${processingTime}ms")

                // Dispatch completion event
                LaravelBridge.dispatchEvent(
                    "NativePHP\\MobileMlkit\\Events\\DetectionCompleted",
                    mapOf(
                        "detections" to detections,
                        "processingTimeMs" to processingTime,
                        "imagePath" to imagePath
                    )
                )

                BridgeResponse.success(mapOf(
                    "detections" to detections,
                    "processingTimeMs" to processingTime
                ))
            } catch (e: Exception) {
                Log.e(TAG, "❌ Detection failed: ${e.message}", e)
                BridgeResponse.error("Detection failed: ${e.message}")
            }
        }
    }

    /**
     * Stop real-time detection
     * Parameters: none
     * Returns:
     *   - stopped: Boolean - Whether detection was stopped
     */
    class StopDetection(private val context: Context) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            Log.d(TAG, "⏹️ Stopping detection...")

            return try {
                isDetecting = false
                cameraProvider?.unbindAll()
                cameraExecutor?.shutdown()
                cameraExecutor = null
                imageAnalyzer = null

                Log.d(TAG, "✅ Detection stopped")
                BridgeResponse.success(mapOf("stopped" to true))
            } catch (e: Exception) {
                Log.e(TAG, "❌ Failed to stop detection: ${e.message}", e)
                BridgeResponse.error("Failed to stop detection: ${e.message}")
            }
        }
    }

    /**
     * Get current status
     * Parameters: none
     * Returns:
     *   - modelLoaded: Boolean
     *   - isDetecting: Boolean
     *   - inputWidth: Int
     *   - inputHeight: Int
     *   - labelsCount: Int
     *   - gpuEnabled: Boolean
     */
    class GetStatus(private val context: Context) : BridgeFunction {
        override fun execute(parameters: Map<String, Any>): Map<String, Any> {
            Log.d(TAG, "📊 Getting status...")

            return BridgeResponse.success(mapOf(
                "modelLoaded" to isModelLoaded,
                "isDetecting" to isDetecting,
                "inputWidth" to modelInputWidth,
                "inputHeight" to modelInputHeight,
                "labelsCount" to labels.size,
                "gpuEnabled" to (gpuDelegate != null)
            ))
        }
    }

    // Helper functions

    private fun runInference(bitmap: Bitmap, confidenceThreshold: Float, maxResults: Int): List<Map<String, Any>> {
        val interpreter = interpreter ?: return emptyList()

        // Resize bitmap to model input size
        val resizedBitmap = Bitmap.createScaledBitmap(bitmap, modelInputWidth, modelInputHeight, true)

        // Convert to ByteBuffer
        val inputBuffer = convertBitmapToByteBuffer(resizedBitmap)

        // Prepare output buffer (assuming classification model with N classes)
        val outputSize = if (labels.isNotEmpty()) labels.size else 1000
        val outputBuffer = Array(1) { FloatArray(outputSize) }

        // Run inference
        interpreter.run(inputBuffer, outputBuffer)

        // Process results
        val results = mutableListOf<Map<String, Any>>()
        val scores = outputBuffer[0]

        // Get top results
        val indexedScores = scores.mapIndexed { index, score -> index to score }
            .sortedByDescending { it.second }
            .take(maxResults)

        for ((index, score) in indexedScores) {
            if (score >= confidenceThreshold) {
                val label = if (index < labels.size) labels[index] else "Class $index"
                results.add(mapOf(
                    "label" to label,
                    "confidence" to score,
                    "classIndex" to index
                ))
            }
        }

        return results
    }

    private fun convertBitmapToByteBuffer(bitmap: Bitmap): ByteBuffer {
        val byteBuffer = ByteBuffer.allocateDirect(4 * modelInputWidth * modelInputHeight * 3)
        byteBuffer.order(ByteOrder.nativeOrder())

        val pixels = IntArray(modelInputWidth * modelInputHeight)
        bitmap.getPixels(pixels, 0, modelInputWidth, 0, 0, modelInputWidth, modelInputHeight)

        for (pixel in pixels) {
            // Normalize pixel values to [0, 1]
            byteBuffer.putFloat(((pixel shr 16) and 0xFF) / 255.0f)
            byteBuffer.putFloat(((pixel shr 8) and 0xFF) / 255.0f)
            byteBuffer.putFloat((pixel and 0xFF) / 255.0f)
        }

        byteBuffer.rewind()
        return byteBuffer
    }

    private fun closeInterpreter() {
        interpreter?.close()
        interpreter = null
        gpuDelegate?.close()
        gpuDelegate = null
        isModelLoaded = false
    }

    @androidx.camera.core.ExperimentalGetImage
    private fun ImageProxy.toBitmap(): Bitmap? {
        val image = this.image ?: return null

        val yBuffer = image.planes[0].buffer
        val uBuffer = image.planes[1].buffer
        val vBuffer = image.planes[2].buffer

        val ySize = yBuffer.remaining()
        val uSize = uBuffer.remaining()
        val vSize = vBuffer.remaining()

        val nv21 = ByteArray(ySize + uSize + vSize)
        yBuffer.get(nv21, 0, ySize)
        vBuffer.get(nv21, ySize, vSize)
        uBuffer.get(nv21, ySize + vSize, uSize)

        val yuvImage = android.graphics.YuvImage(nv21, android.graphics.ImageFormat.NV21, width, height, null)
        val out = java.io.ByteArrayOutputStream()
        yuvImage.compressToJpeg(android.graphics.Rect(0, 0, width, height), 100, out)
        val imageBytes = out.toByteArray()
        return BitmapFactory.decodeByteArray(imageBytes, 0, imageBytes.size)
    }
}
