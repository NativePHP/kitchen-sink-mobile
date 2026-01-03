<?php

namespace NativePHP\MobileMlkit\Commands;

use Native\Mobile\Plugins\Commands\NativePluginHookCommand;

class CopyAssetsCommand extends NativePluginHookCommand
{
    protected $signature = 'nativephp:mobile-mlkit:copy-assets';

    protected $description = 'Copy TensorFlow Lite models and assets for MobileMlkit plugin';

    public function handle(): int
    {
        $this->info('MobileMlkit: Copying ML assets...');

        if ($this->isAndroid()) {
            $this->copyAndroidAssets();
        }

        if ($this->isIos()) {
            $this->copyIosAssets();
        }

        return self::SUCCESS;
    }

    protected function copyAndroidAssets(): void
    {
        // Copy TensorFlow Lite model to Android assets
        // Users should place their model at: resources/models/shark_teeth.tflite
        $modelSource = 'models/shark_teeth.tflite';
        $modelDest = 'models/shark_teeth.tflite';

        if (file_exists($this->pluginPath().'/resources/'.$modelSource)) {
            $this->copyToAndroidAssets($modelSource, $modelDest);
        } else {
            $this->warn("Model file not found: resources/{$modelSource}");
            $this->info('Place your TensorFlow Lite model at: resources/models/shark_teeth.tflite');
        }

        // Copy labels file if present
        $labelsSource = 'models/labels.txt';
        $labelsDest = 'models/labels.txt';

        if (file_exists($this->pluginPath().'/resources/'.$labelsSource)) {
            $this->copyToAndroidAssets($labelsSource, $labelsDest);
        }

        $this->info('Android assets processing complete for MobileMlkit');
    }

    protected function copyIosAssets(): void
    {
        // Copy TensorFlow Lite model to iOS bundle
        // Users should place their model at: resources/models/shark_teeth.tflite
        $modelSource = 'models/shark_teeth.tflite';
        $modelDest = 'models/shark_teeth.tflite';

        if (file_exists($this->pluginPath().'/resources/'.$modelSource)) {
            $this->copyToIosBundle($modelSource, $modelDest);
        } else {
            $this->warn("Model file not found: resources/{$modelSource}");
            $this->info('Place your TensorFlow Lite model at: resources/models/shark_teeth.tflite');
        }

        // Copy labels file if present
        $labelsSource = 'models/labels.txt';
        $labelsDest = 'models/labels.txt';

        if (file_exists($this->pluginPath().'/resources/'.$labelsSource)) {
            $this->copyToIosBundle($labelsSource, $labelsDest);
        }

        $this->info('iOS assets processing complete for MobileMlkit');
    }
}
