<?php

namespace NativePHP\MobileMlkit;

class MobileMlkit
{
    /**
     * Load a TensorFlow Lite model for inference
     *
     * @param string $modelPath Path to the .tflite model file (relative to assets)
     * @param array $options Additional options like labels file path, GPU acceleration, etc.
     */
    public function loadModel(string $modelPath, array $options = []): ?object
    {
        if (function_exists('nativephp_call')) {
            $params = array_merge(['modelPath' => $modelPath], $options);
            $result = nativephp_call('MobileMlkit.LoadModel', json_encode($params));

            if ($result) {
                $decoded = json_decode($result);

                return $decoded->data ?? null;
            }
        }

        return null;
    }

    /**
     * Start real-time detection from camera feed
     *
     * @param array $options Detection options (confidence threshold, max results, etc.)
     */
    public function detectFromCamera(array $options = []): ?object
    {
        if (function_exists('nativephp_call')) {
            $defaults = [
                'confidenceThreshold' => 0.5,
                'maxResults' => 5,
                'useGpu' => true,
            ];

            $result = nativephp_call('MobileMlkit.DetectFromCamera', json_encode(array_merge($defaults, $options)));

            if ($result) {
                $decoded = json_decode($result);

                return $decoded->data ?? null;
            }
        }

        return null;
    }

    /**
     * Run detection on a static image
     *
     * @param string $imagePath Path to the image file
     * @param array $options Detection options
     */
    public function detectFromImage(string $imagePath, array $options = []): ?array
    {
        if (function_exists('nativephp_call')) {
            $params = array_merge(['imagePath' => $imagePath], $options);
            $result = nativephp_call('MobileMlkit.DetectFromImage', json_encode($params));

            if ($result) {
                $decoded = json_decode($result);

                return $decoded->data->detections ?? null;
            }
        }

        return null;
    }

    /**
     * Stop real-time detection
     */
    public function stopDetection(): bool
    {
        if (function_exists('nativephp_call')) {
            $result = nativephp_call('MobileMlkit.StopDetection', '{}');

            if ($result) {
                $decoded = json_decode($result);

                return ($decoded->data->stopped ?? false) === true;
            }
        }

        return false;
    }

    /**
     * Get current detection status and loaded model info
     */
    public function getStatus(): ?object
    {
        if (function_exists('nativephp_call')) {
            $result = nativephp_call('MobileMlkit.GetStatus', '{}');

            if ($result) {
                $decoded = json_decode($result);

                return $decoded->data ?? null;
            }
        }

        return null;
    }
}
