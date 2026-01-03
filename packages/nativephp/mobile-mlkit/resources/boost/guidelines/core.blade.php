## nativephp/mobile-mlkit

TensorFlow Lite ML Kit integration for NativePHP Mobile - Shark teeth detection and custom object recognition.

### Installation

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

### Adding Your TFLite Model

Place your TensorFlow Lite model and labels in the plugin's resources directory:

```
packages/nativephp/mobile-mlkit/resources/
├── models/
│   ├── shark_teeth.tflite    # Your trained model
│   └── labels.txt            # Class labels (one per line)
```

The model will be automatically copied to the native app during build via the `copy_assets` hook.

### PHP Usage (Livewire/Blade)

Use the `MobileMlkit` facade:

@verbatim
<code-snippet name="Loading a model and running detection" lang="php">
use NativePHP\MobileMlkit\Facades\MobileMlkit;

// Load the TensorFlow Lite model
$result = MobileMlkit::loadModel('models/shark_teeth.tflite', [
    'labelsPath' => 'models/labels.txt',
    'useGpu' => true,
    'inputWidth' => 224,
    'inputHeight' => 224,
]);

// Start real-time camera detection
MobileMlkit::detectFromCamera([
    'confidenceThreshold' => 0.7,
    'maxResults' => 5,
]);

// Or detect from a specific image
$detections = MobileMlkit::detectFromImage('/path/to/image.jpg', [
    'confidenceThreshold' => 0.5,
]);

// Stop detection when done
MobileMlkit::stopDetection();

// Check current status
$status = MobileMlkit::getStatus();
</code-snippet>
@endverbatim

### Available Methods

| Method | Description |
|--------|-------------|
| `MobileMlkit::loadModel($path, $options)` | Load a TFLite model for inference |
| `MobileMlkit::detectFromCamera($options)` | Start real-time camera detection |
| `MobileMlkit::detectFromImage($path, $options)` | Run detection on a static image |
| `MobileMlkit::stopDetection()` | Stop real-time detection |
| `MobileMlkit::getStatus()` | Get current detection status |

### Events

Listen for detection events in your Livewire components:

@verbatim
<code-snippet name="Listening for shark tooth detection events" lang="php">
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use NativePHP\MobileMlkit\Events\SharkToothDetected;
use NativePHP\MobileMlkit\Events\DetectionCompleted;
use NativePHP\MobileMlkit\Events\ModelLoaded;

class SharkToothDetector extends Component
{
    public array $detections = [];
    public bool $modelLoaded = false;

    #[OnNative(ModelLoaded::class)]
    public function handleModelLoaded($modelPath, $gpuEnabled, $inputWidth, $inputHeight)
    {
        $this->modelLoaded = true;
    }

    #[OnNative(SharkToothDetected::class)]
    public function handleSharkToothDetected($label, $confidence, $boundingBox = null)
    {
        $this->detections[] = [
            'label' => $label,
            'confidence' => round($confidence * 100, 1) . '%',
        ];
    }

    #[OnNative(DetectionCompleted::class)]
    public function handleDetectionCompleted($detections, $processingTimeMs, $imagePath = null)
    {
        // Handle batch of detections
        // $detections contains all detected items
        // $processingTimeMs indicates inference time
    }
}
</code-snippet>
@endverbatim

### JavaScript Usage (Vue/React/Inertia)

@verbatim
<code-snippet name="Using MobileMlkit in JavaScript" lang="javascript">
import { mobileMlkit } from '@nativephp/mobile-mlkit';

// Load model
await mobileMlkit.loadModel('models/shark_teeth.tflite', {
    labelsPath: 'models/labels.txt',
    useGpu: true
});

// Start camera detection
await mobileMlkit.detectFromCamera({
    confidenceThreshold: 0.7,
    maxResults: 3
});

// Listen for detection events
Native.on('SharkToothDetected', (data) => {
    console.log('Detected:', data.label, 'Confidence:', data.confidence);
});

Native.on('DetectionCompleted', (data) => {
    console.log('Batch complete:', data.detections.length, 'items');
    console.log('Processing time:', data.processingTimeMs, 'ms');
});

// Detect from image
const results = await mobileMlkit.detectFromImage('/path/to/photo.jpg');

// Stop detection
await mobileMlkit.stopDetection();

// Check status
const status = await mobileMlkit.getStatus();
</code-snippet>
@endverbatim

### Model Requirements

Your TensorFlow Lite model should:

- Accept input images of shape `[1, height, width, 3]` (RGB)
- Output classification probabilities of shape `[1, num_classes]`
- Use float32 input/output tensors
- Be quantized for mobile if performance is critical

### Configuration Options

#### loadModel Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `labelsPath` | string | null | Path to labels.txt file |
| `useGpu` | boolean | true | Enable GPU/CoreML acceleration |
| `inputWidth` | int | 224 | Model input width |
| `inputHeight` | int | 224 | Model input height |

#### Detection Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `confidenceThreshold` | float | 0.5 | Minimum confidence (0-1) |
| `maxResults` | int | 5 | Maximum detections to return |

### Permissions

This plugin requires camera permission. Add to your `config/nativephp.php`:

```php
'permissions' => [
    'camera' => true,
],
```
