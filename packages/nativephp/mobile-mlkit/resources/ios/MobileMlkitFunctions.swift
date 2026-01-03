import Foundation
import UIKit
import AVFoundation
import TensorFlowLite

/// MobileMlkit Bridge Functions
/// Provides TensorFlow Lite inference for shark teeth detection
/// Namespace: "MobileMlkit.*"
enum MobileMlkitFunctions {

    // MARK: - Shared State

    private static var interpreter: Interpreter?
    private static var isModelLoaded = false
    private static var isDetecting = false
    private static var modelInputWidth = 224
    private static var modelInputHeight = 224
    private static var labels: [String] = []
    private static var captureSession: AVCaptureSession?
    private static var videoOutput: AVCaptureVideoDataOutput?
    private static var confidenceThreshold: Float = 0.5
    private static var maxResults: Int = 5

    // MARK: - LoadModel

    /// Load a TensorFlow Lite model for inference
    /// Parameters:
    ///   - modelPath: String - Path to the .tflite model file (relative to bundle)
    ///   - labelsPath: String? - Optional path to labels.txt file
    ///   - useGpu: Boolean - Whether to use GPU acceleration (default: true)
    ///   - inputWidth: Int - Model input width (default: 224)
    ///   - inputHeight: Int - Model input height (default: 224)
    class LoadModel: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            print("📦 MobileMlkit: Loading TensorFlow Lite model...")

            guard let modelPath = parameters["modelPath"] as? String else {
                return BridgeResponse.error(message: "Model path is required")
            }

            let labelsPath = parameters["labelsPath"] as? String
            let useGpu = parameters["useGpu"] as? Bool ?? true
            MobileMlkitFunctions.modelInputWidth = parameters["inputWidth"] as? Int ?? 224
            MobileMlkitFunctions.modelInputHeight = parameters["inputHeight"] as? Int ?? 224

            do {
                // Close existing interpreter
                MobileMlkitFunctions.interpreter = nil
                MobileMlkitFunctions.isModelLoaded = false

                // Get model path from bundle
                guard let modelURL = Bundle.main.url(forResource: modelPath.replacingOccurrences(of: ".tflite", with: ""),
                                                      withExtension: "tflite",
                                                      subdirectory: "models") else {
                    // Try direct path in Resources
                    guard let resourcePath = Bundle.main.resourcePath else {
                        return BridgeResponse.error(message: "Could not find model file: \(modelPath)")
                    }

                    let fullPath = (resourcePath as NSString).appendingPathComponent(modelPath)
                    if !FileManager.default.fileExists(atPath: fullPath) {
                        return BridgeResponse.error(message: "Model file not found: \(modelPath)")
                    }

                    try loadInterpreter(from: fullPath, useGpu: useGpu)
                    try loadLabelsIfNeeded(labelsPath)
                    return successResponse(modelPath: modelPath)
                }

                try loadInterpreter(from: modelURL.path, useGpu: useGpu)
                try loadLabelsIfNeeded(labelsPath)

                return successResponse(modelPath: modelPath)
            } catch {
                print("❌ MobileMlkit: Failed to load model: \(error.localizedDescription)")
                return BridgeResponse.error(message: "Failed to load model: \(error.localizedDescription)")
            }
        }

        private func loadInterpreter(from path: String, useGpu: Bool) throws {
            var options = Interpreter.Options()
            options.threadCount = 4

            // Configure GPU delegate if available and requested
            if useGpu {
                var gpuOptions = CoreMLDelegate.Options()
                gpuOptions.enabledDevices = .all

                if let coreMLDelegate = CoreMLDelegate(options: gpuOptions) {
                    options.delegates = [coreMLDelegate]
                    print("✅ MobileMlkit: CoreML delegate enabled")
                } else {
                    print("⚠️ MobileMlkit: CoreML delegate not available, using CPU")
                }
            }

            MobileMlkitFunctions.interpreter = try Interpreter(modelPath: path, options: options)
            try MobileMlkitFunctions.interpreter?.allocateTensors()
            MobileMlkitFunctions.isModelLoaded = true
            print("✅ MobileMlkit: Model loaded successfully")
        }

        private func loadLabelsIfNeeded(_ labelsPath: String?) throws {
            guard let labelsPath = labelsPath else { return }

            if let labelsURL = Bundle.main.url(forResource: labelsPath.replacingOccurrences(of: ".txt", with: ""),
                                                withExtension: "txt",
                                                subdirectory: "models") {
                let content = try String(contentsOf: labelsURL, encoding: .utf8)
                MobileMlkitFunctions.labels = content.components(separatedBy: .newlines).filter { !$0.isEmpty }
                print("✅ MobileMlkit: Loaded \(MobileMlkitFunctions.labels.count) labels")
            }
        }

        private func successResponse(modelPath: String) -> [String: Any] {
            // Dispatch event
            LaravelBridge.dispatchEvent(
                "NativePHP\\MobileMlkit\\Events\\ModelLoaded",
                data: [
                    "modelPath": modelPath,
                    "gpuEnabled": true,
                    "inputWidth": MobileMlkitFunctions.modelInputWidth,
                    "inputHeight": MobileMlkitFunctions.modelInputHeight
                ]
            )

            return BridgeResponse.success(data: [
                "loaded": true,
                "inputWidth": MobileMlkitFunctions.modelInputWidth,
                "inputHeight": MobileMlkitFunctions.modelInputHeight,
                "labelsCount": MobileMlkitFunctions.labels.count,
                "gpuEnabled": true
            ])
        }
    }

    // MARK: - DetectFromCamera

    /// Start real-time detection from camera feed
    /// Parameters:
    ///   - confidenceThreshold: Float - Minimum confidence for detection (default: 0.5)
    ///   - maxResults: Int - Maximum number of results to return (default: 5)
    class DetectFromCamera: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            print("📷 MobileMlkit: Starting camera detection...")

            guard MobileMlkitFunctions.isModelLoaded, MobileMlkitFunctions.interpreter != nil else {
                return BridgeResponse.error(message: "Model not loaded. Call LoadModel first.")
            }

            if MobileMlkitFunctions.isDetecting {
                return BridgeResponse.error(message: "Detection already in progress")
            }

            MobileMlkitFunctions.confidenceThreshold = parameters["confidenceThreshold"] as? Float ?? 0.5
            MobileMlkitFunctions.maxResults = parameters["maxResults"] as? Int ?? 5

            // Set up camera session
            let session = AVCaptureSession()
            session.sessionPreset = .medium

            guard let device = AVCaptureDevice.default(.builtInWideAngleCamera, for: .video, position: .back),
                  let input = try? AVCaptureDeviceInput(device: device) else {
                return BridgeResponse.error(message: "Camera not available")
            }

            if session.canAddInput(input) {
                session.addInput(input)
            }

            let output = AVCaptureVideoDataOutput()
            output.setSampleBufferDelegate(CameraDelegate.shared, queue: DispatchQueue(label: "mobileMlkitCamera"))

            if session.canAddOutput(output) {
                session.addOutput(output)
            }

            MobileMlkitFunctions.captureSession = session
            MobileMlkitFunctions.videoOutput = output
            MobileMlkitFunctions.isDetecting = true

            DispatchQueue.global(qos: .userInitiated).async {
                session.startRunning()
            }

            print("✅ MobileMlkit: Camera detection started")

            return BridgeResponse.success(data: [
                "started": true,
                "confidenceThreshold": MobileMlkitFunctions.confidenceThreshold,
                "maxResults": MobileMlkitFunctions.maxResults
            ])
        }
    }

    // MARK: - Camera Delegate

    private class CameraDelegate: NSObject, AVCaptureVideoDataOutputSampleBufferDelegate {
        static let shared = CameraDelegate()

        func captureOutput(_ output: AVCaptureOutput, didOutput sampleBuffer: CMSampleBuffer, from connection: AVCaptureConnection) {
            guard MobileMlkitFunctions.isDetecting else { return }

            let startTime = CFAbsoluteTimeGetCurrent()

            guard let pixelBuffer = CMSampleBufferGetImageBuffer(sampleBuffer) else { return }

            if let detections = MobileMlkitFunctions.runInference(
                pixelBuffer: pixelBuffer,
                confidenceThreshold: MobileMlkitFunctions.confidenceThreshold,
                maxResults: MobileMlkitFunctions.maxResults
            ) {
                let processingTime = Int((CFAbsoluteTimeGetCurrent() - startTime) * 1000)

                if !detections.isEmpty {
                    // Dispatch detection events
                    for detection in detections {
                        LaravelBridge.dispatchEvent(
                            "NativePHP\\MobileMlkit\\Events\\SharkToothDetected",
                            data: detection
                        )
                    }

                    // Dispatch completion event
                    LaravelBridge.dispatchEvent(
                        "NativePHP\\MobileMlkit\\Events\\DetectionCompleted",
                        data: [
                            "detections": detections,
                            "processingTimeMs": processingTime
                        ]
                    )
                }
            }
        }
    }

    // MARK: - DetectFromImage

    /// Run detection on a static image
    /// Parameters:
    ///   - imagePath: String - Path to the image file
    ///   - confidenceThreshold: Float - Minimum confidence (default: 0.5)
    ///   - maxResults: Int - Maximum results (default: 5)
    class DetectFromImage: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            print("🖼️ MobileMlkit: Running detection on image...")

            guard MobileMlkitFunctions.isModelLoaded, MobileMlkitFunctions.interpreter != nil else {
                return BridgeResponse.error(message: "Model not loaded. Call LoadModel first.")
            }

            guard let imagePath = parameters["imagePath"] as? String else {
                return BridgeResponse.error(message: "Image path is required")
            }

            let confidenceThreshold = parameters["confidenceThreshold"] as? Float ?? 0.5
            let maxResults = parameters["maxResults"] as? Int ?? 5

            let startTime = CFAbsoluteTimeGetCurrent()

            guard let image = UIImage(contentsOfFile: imagePath),
                  let pixelBuffer = image.pixelBuffer(width: MobileMlkitFunctions.modelInputWidth,
                                                       height: MobileMlkitFunctions.modelInputHeight) else {
                return BridgeResponse.error(message: "Failed to load image: \(imagePath)")
            }

            guard let detections = MobileMlkitFunctions.runInference(
                pixelBuffer: pixelBuffer,
                confidenceThreshold: confidenceThreshold,
                maxResults: maxResults
            ) else {
                return BridgeResponse.error(message: "Inference failed")
            }

            let processingTime = Int((CFAbsoluteTimeGetCurrent() - startTime) * 1000)

            print("✅ MobileMlkit: Detection complete: \(detections.count) results in \(processingTime)ms")

            // Dispatch completion event
            LaravelBridge.dispatchEvent(
                "NativePHP\\MobileMlkit\\Events\\DetectionCompleted",
                data: [
                    "detections": detections,
                    "processingTimeMs": processingTime,
                    "imagePath": imagePath
                ]
            )

            return BridgeResponse.success(data: [
                "detections": detections,
                "processingTimeMs": processingTime
            ])
        }
    }

    // MARK: - StopDetection

    /// Stop real-time detection
    class StopDetection: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            print("⏹️ MobileMlkit: Stopping detection...")

            MobileMlkitFunctions.isDetecting = false
            MobileMlkitFunctions.captureSession?.stopRunning()
            MobileMlkitFunctions.captureSession = nil
            MobileMlkitFunctions.videoOutput = nil

            print("✅ MobileMlkit: Detection stopped")

            return BridgeResponse.success(data: ["stopped": true])
        }
    }

    // MARK: - GetStatus

    /// Get current status
    class GetStatus: BridgeFunction {
        func execute(parameters: [String: Any]) throws -> [String: Any] {
            print("📊 MobileMlkit: Getting status...")

            return BridgeResponse.success(data: [
                "modelLoaded": MobileMlkitFunctions.isModelLoaded,
                "isDetecting": MobileMlkitFunctions.isDetecting,
                "inputWidth": MobileMlkitFunctions.modelInputWidth,
                "inputHeight": MobileMlkitFunctions.modelInputHeight,
                "labelsCount": MobileMlkitFunctions.labels.count,
                "gpuEnabled": true
            ])
        }
    }

    // MARK: - Helper Functions

    private static func runInference(pixelBuffer: CVPixelBuffer, confidenceThreshold: Float, maxResults: Int) -> [[String: Any]]? {
        guard let interpreter = interpreter else { return nil }

        do {
            // Resize and convert pixel buffer to Data
            let inputData = preprocessPixelBuffer(pixelBuffer)

            // Copy input data to interpreter
            try interpreter.copy(inputData, toInputAt: 0)

            // Run inference
            try interpreter.invoke()

            // Get output
            let outputTensor = try interpreter.output(at: 0)
            let outputData = outputTensor.data

            // Convert to Float array
            let outputSize = outputData.count / MemoryLayout<Float>.size
            var outputArray = [Float](repeating: 0, count: outputSize)
            _ = outputArray.withUnsafeMutableBufferPointer { buffer in
                outputData.copyBytes(to: buffer)
            }

            // Process results
            var results: [[String: Any]] = []
            let indexedScores = outputArray.enumerated()
                .sorted { $0.element > $1.element }
                .prefix(maxResults)

            for (index, score) in indexedScores {
                if score >= confidenceThreshold {
                    let label = index < labels.count ? labels[index] : "Class \(index)"
                    results.append([
                        "label": label,
                        "confidence": score,
                        "classIndex": index
                    ])
                }
            }

            return results
        } catch {
            print("❌ MobileMlkit: Inference error: \(error.localizedDescription)")
            return nil
        }
    }

    private static func preprocessPixelBuffer(_ pixelBuffer: CVPixelBuffer) -> Data {
        CVPixelBufferLockBaseAddress(pixelBuffer, .readOnly)
        defer { CVPixelBufferUnlockBaseAddress(pixelBuffer, .readOnly) }

        let width = CVPixelBufferGetWidth(pixelBuffer)
        let height = CVPixelBufferGetHeight(pixelBuffer)
        let baseAddress = CVPixelBufferGetBaseAddress(pixelBuffer)!

        var inputData = Data(count: modelInputWidth * modelInputHeight * 3 * MemoryLayout<Float>.size)

        // Simple resize and normalize (in production, use vImage for better performance)
        let scaleX = Float(width) / Float(modelInputWidth)
        let scaleY = Float(height) / Float(modelInputHeight)

        inputData.withUnsafeMutableBytes { ptr in
            let floatPtr = ptr.bindMemory(to: Float.self)
            var index = 0

            for y in 0..<modelInputHeight {
                for x in 0..<modelInputWidth {
                    let srcX = Int(Float(x) * scaleX)
                    let srcY = Int(Float(y) * scaleY)

                    let pixelOffset = srcY * CVPixelBufferGetBytesPerRow(pixelBuffer) + srcX * 4
                    let pixel = baseAddress.advanced(by: pixelOffset)

                    let b = Float(pixel.load(fromByteOffset: 0, as: UInt8.self)) / 255.0
                    let g = Float(pixel.load(fromByteOffset: 1, as: UInt8.self)) / 255.0
                    let r = Float(pixel.load(fromByteOffset: 2, as: UInt8.self)) / 255.0

                    floatPtr[index] = r
                    floatPtr[index + 1] = g
                    floatPtr[index + 2] = b
                    index += 3
                }
            }
        }

        return inputData
    }
}

// MARK: - UIImage Extension

extension UIImage {
    func pixelBuffer(width: Int, height: Int) -> CVPixelBuffer? {
        var pixelBuffer: CVPixelBuffer?
        let attrs = [
            kCVPixelBufferCGImageCompatibilityKey: kCFBooleanTrue,
            kCVPixelBufferCGBitmapContextCompatibilityKey: kCFBooleanTrue
        ] as CFDictionary

        let status = CVPixelBufferCreate(
            kCFAllocatorDefault,
            width,
            height,
            kCVPixelFormatType_32BGRA,
            attrs,
            &pixelBuffer
        )

        guard status == kCVReturnSuccess, let buffer = pixelBuffer else { return nil }

        CVPixelBufferLockBaseAddress(buffer, [])
        defer { CVPixelBufferUnlockBaseAddress(buffer, []) }

        guard let context = CGContext(
            data: CVPixelBufferGetBaseAddress(buffer),
            width: width,
            height: height,
            bitsPerComponent: 8,
            bytesPerRow: CVPixelBufferGetBytesPerRow(buffer),
            space: CGColorSpaceCreateDeviceRGB(),
            bitmapInfo: CGImageAlphaInfo.premultipliedFirst.rawValue | CGBitmapInfo.byteOrder32Little.rawValue
        ) else { return nil }

        guard let cgImage = self.cgImage else { return nil }

        context.draw(cgImage, in: CGRect(x: 0, y: 0, width: width, height: height))

        return buffer
    }
}
