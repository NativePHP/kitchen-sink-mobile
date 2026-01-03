# MobileMlkit Plugin for NativePHP Mobile

TensorFlow Lite ML Kit integration for NativePHP Mobile - Shark teeth detection and custom object recognition.

## Features

- 🦈 Real-time object detection from camera feed
- 📷 Static image classification
- 🚀 GPU acceleration (Android GPU Delegate, iOS CoreML)
- 📱 Cross-platform (iOS & Android)
- ⚡ Event-driven architecture for detection results

## Installation

```bash
# Install the package
composer require nativephp/mobile-mlkit

# Publish the plugins provider (first time only)
php artisan vendor:publish --tag=nativephp-plugins-provider

# Register the plugin
php artisan native:plugin:register nativephp/mobile-mlkit

# Verify registration
php artisan native:plugin:list
```

This adds `\NativePHP\MobileMlkit\MobileMlkitServiceProvider::class` to your `plugins()` array.

## Adding Your Model

Place your TensorFlow Lite model in the plugin's resources directory:

```
packages/nativephp/mobile-mlkit/resources/
├── models/
│   ├── shark_teeth.tflite    # Your trained TFLite model
│   └── labels.txt            # Class labels (one per line)
```

The `labels.txt` file should contain one class label per line:

```
megalodon
great_white
mako
tiger_shark
bull_shark
```

## Usage

### PHP (Livewire/Blade)

```php
use NativePHP\MobileMlkit\Facades\MobileMlkit;

// Load the model
MobileMlkit::loadModel('models/shark_teeth.tflite', [
    'labelsPath' => 'models/labels.txt',
    'useGpu' => true,
]);

// Start camera detection
MobileMlkit::detectFromCamera([
    'confidenceThreshold' => 0.7,
    'maxResults' => 5,
]);

// Or detect from an image
$results = MobileMlkit::detectFromImage('/path/to/image.jpg');

// Stop detection
MobileMlkit::stopDetection();

// Check status
$status = MobileMlkit::getStatus();
```

### Listening for Events

```php
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileMlkit\Events\SharkToothDetected;

class SharkDetector extends Component
{
    public array $detections = [];

    #[OnNative(SharkToothDetected::class)]
    public function onDetection($label, $confidence, $boundingBox = null)
    {
        $this->detections[] = [
            'label' => $label,
            'confidence' => $confidence,
        ];
    }
}
```

### JavaScript (Vue/React/Inertia)

```javascript
import { mobileMlkit } from '@nativephp/mobile-mlkit';

// Load model
await mobileMlkit.loadModel('models/shark_teeth.tflite', {
    labelsPath: 'models/labels.txt'
});

// Start detection
await mobileMlkit.detectFromCamera({ confidenceThreshold: 0.7 });

// Listen for events
Native.on('SharkToothDetected', (data) => {
    console.log('Found:', data.label, data.confidence);
});
```

## Events

| Event | Data | Description |
|-------|------|-------------|
| `ModelLoaded` | `modelPath`, `gpuEnabled`, `inputWidth`, `inputHeight` | Fired when model is loaded |
| `SharkToothDetected` | `label`, `confidence`, `boundingBox` | Fired for each detection |
| `DetectionCompleted` | `detections`, `processingTimeMs`, `imagePath` | Fired when batch completes |

## API Reference

### `loadModel(modelPath, options)`

Load a TensorFlow Lite model.

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `labelsPath` | string | null | Path to labels file |
| `useGpu` | boolean | true | Enable GPU acceleration |
| `inputWidth` | int | 224 | Model input width |
| `inputHeight` | int | 224 | Model input height |

### `detectFromCamera(options)`

Start real-time camera detection.

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `confidenceThreshold` | float | 0.5 | Min confidence (0-1) |
| `maxResults` | int | 5 | Max results per frame |

### `detectFromImage(imagePath, options)`

Run detection on a static image.

### `stopDetection()`

Stop real-time camera detection.

### `getStatus()`

Get current model and detection status.

## Model Requirements

Your TensorFlow Lite model should:

- Input: `[1, height, width, 3]` RGB float32 tensor
- Output: `[1, num_classes]` classification probabilities
- Recommended: Quantized INT8 model for better mobile performance

## Native Dependencies

### Android

- TensorFlow Lite 2.14.0
- TensorFlow Lite GPU Delegate
- CameraX 1.3.1

### iOS

- TensorFlowLiteSwift 2.14.0
- AVFoundation (Camera)
- CoreML Delegate

## License

MIT
