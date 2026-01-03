/**
 * MobileMlkit Plugin for NativePHP Mobile
 * TensorFlow Lite inference for shark teeth detection
 *
 * @example
 * import { mobileMlkit } from '@nativephp/mobile-mlkit';
 *
 * // Load model
 * await mobileMlkit.loadModel('models/shark_teeth.tflite', {
 *     labelsPath: 'models/labels.txt',
 *     useGpu: true
 * });
 *
 * // Detect from camera
 * await mobileMlkit.detectFromCamera({
 *     confidenceThreshold: 0.7,
 *     maxResults: 3
 * });
 *
 * // Listen for detections
 * Native.on('SharkToothDetected', (data) => {
 *     console.log('Detected:', data.label, data.confidence);
 * });
 */

const baseUrl = '/_native/api/call';

async function bridgeCall(method, params = {}) {
    const response = await fetch(baseUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ method, params })
    });

    const result = await response.json();

    if (result.status === 'error') {
        throw new Error(result.message || 'Native call failed');
    }

    const nativeResponse = result.data;
    if (nativeResponse && nativeResponse.data !== undefined) {
        return nativeResponse.data;
    }

    return nativeResponse;
}

/**
 * Load a TensorFlow Lite model for inference
 *
 * @param {string} modelPath - Path to the .tflite model file (relative to assets)
 * @param {Object} options - Additional options
 * @param {string} [options.labelsPath] - Path to labels.txt file
 * @param {boolean} [options.useGpu=true] - Whether to use GPU acceleration
 * @param {number} [options.inputWidth=224] - Model input width
 * @param {number} [options.inputHeight=224] - Model input height
 * @returns {Promise<Object>} - Load result with model info
 */
export async function loadModel(modelPath, options = {}) {
    return bridgeCall('MobileMlkit.LoadModel', {
        modelPath,
        ...options
    });
}

/**
 * Start real-time detection from camera feed
 *
 * @param {Object} options - Detection options
 * @param {number} [options.confidenceThreshold=0.5] - Minimum confidence for detection
 * @param {number} [options.maxResults=5] - Maximum number of results to return
 * @returns {Promise<Object>} - Result indicating detection started
 */
export async function detectFromCamera(options = {}) {
    return bridgeCall('MobileMlkit.DetectFromCamera', {
        confidenceThreshold: 0.5,
        maxResults: 5,
        ...options
    });
}

/**
 * Run detection on a static image
 *
 * @param {string} imagePath - Path to the image file
 * @param {Object} options - Detection options
 * @param {number} [options.confidenceThreshold=0.5] - Minimum confidence
 * @param {number} [options.maxResults=5] - Maximum results
 * @returns {Promise<Object>} - Detection results
 */
export async function detectFromImage(imagePath, options = {}) {
    return bridgeCall('MobileMlkit.DetectFromImage', {
        imagePath,
        confidenceThreshold: 0.5,
        maxResults: 5,
        ...options
    });
}

/**
 * Stop real-time detection
 *
 * @returns {Promise<Object>} - Result indicating detection stopped
 */
export async function stopDetection() {
    return bridgeCall('MobileMlkit.StopDetection');
}

/**
 * Get current detection status
 *
 * @returns {Promise<Object>} - Current status info
 */
export async function getStatus() {
    return bridgeCall('MobileMlkit.GetStatus');
}

/**
 * MobileMlkit namespace object
 */
export const mobileMlkit = {
    loadModel,
    detectFromCamera,
    detectFromImage,
    stopDetection,
    getStatus
};

export default mobileMlkit;
