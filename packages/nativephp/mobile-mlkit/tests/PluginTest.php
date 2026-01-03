<?php

beforeEach(function () {
    $this->pluginPath = dirname(__DIR__);
    $this->manifestPath = $this->pluginPath.'/nativephp.json';
});

describe('Plugin Manifest', function () {
    it('has a valid nativephp.json file', function () {
        expect(file_exists($this->manifestPath))->toBeTrue();

        $content = file_get_contents($this->manifestPath);
        $manifest = json_decode($content, true);

        expect(json_last_error())->toBe(JSON_ERROR_NONE);
    });

    it('has required fields', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest)->toHaveKeys(['namespace', 'bridge_functions']);
    });

    it('has valid bridge functions', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest['bridge_functions'])->toBeArray();

        foreach ($manifest['bridge_functions'] as $function) {
            expect($function)->toHaveKeys(['name']);
            expect($function)->toHaveAnyKeys(['android', 'ios']);
        }
    });

    it('defines MobileMlkit namespace', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest['namespace'])->toBe('MobileMlkit');
    });

    it('has expected bridge functions', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        $functionNames = array_column($manifest['bridge_functions'], 'name');

        expect($functionNames)->toContain('MobileMlkit.LoadModel');
        expect($functionNames)->toContain('MobileMlkit.DetectFromCamera');
        expect($functionNames)->toContain('MobileMlkit.DetectFromImage');
        expect($functionNames)->toContain('MobileMlkit.StopDetection');
        expect($functionNames)->toContain('MobileMlkit.GetStatus');
    });

    it('has camera permission for Android', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest['android']['permissions'])->toContain('android.permission.CAMERA');
    });

    it('has camera usage description for iOS', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest['ios']['info_plist'])->toHaveKey('NSCameraUsageDescription');
    });

    it('has TensorFlow Lite dependencies for Android', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        $dependencies = $manifest['android']['dependencies']['implementation'];
        $hasTflite = false;

        foreach ($dependencies as $dep) {
            if (str_contains($dep, 'tensorflow-lite')) {
                $hasTflite = true;
                break;
            }
        }

        expect($hasTflite)->toBeTrue();
    });

    it('has TensorFlow Lite pod for iOS', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        $pods = $manifest['ios']['dependencies']['pods'];
        $hasTflite = false;

        foreach ($pods as $pod) {
            if (str_contains($pod['name'], 'TensorFlowLite')) {
                $hasTflite = true;
                break;
            }
        }

        expect($hasTflite)->toBeTrue();
    });

    it('defines copy_assets hook', function () {
        $manifest = json_decode(file_get_contents($this->manifestPath), true);

        expect($manifest['hooks'])->toHaveKey('copy_assets');
        expect($manifest['hooks']['copy_assets'])->toBe('nativephp:mobile-mlkit:copy-assets');
    });
});

describe('Native Code', function () {
    it('has Android Kotlin file', function () {
        $kotlinFile = $this->pluginPath.'/resources/android/MobileMlkitFunctions.kt';
        expect(file_exists($kotlinFile))->toBeTrue();
    });

    it('has iOS Swift file', function () {
        $swiftFile = $this->pluginPath.'/resources/ios/MobileMlkitFunctions.swift';
        expect(file_exists($swiftFile))->toBeTrue();
    });

    it('has JavaScript module', function () {
        $jsFile = $this->pluginPath.'/resources/js/mobileMlkit.js';
        expect(file_exists($jsFile))->toBeTrue();
    });

    it('Kotlin file implements all bridge functions', function () {
        $kotlinFile = $this->pluginPath.'/resources/android/MobileMlkitFunctions.kt';
        $content = file_get_contents($kotlinFile);

        expect($content)->toContain('class LoadModel');
        expect($content)->toContain('class DetectFromCamera');
        expect($content)->toContain('class DetectFromImage');
        expect($content)->toContain('class StopDetection');
        expect($content)->toContain('class GetStatus');
    });

    it('Swift file implements all bridge functions', function () {
        $swiftFile = $this->pluginPath.'/resources/ios/MobileMlkitFunctions.swift';
        $content = file_get_contents($swiftFile);

        expect($content)->toContain('class LoadModel');
        expect($content)->toContain('class DetectFromCamera');
        expect($content)->toContain('class DetectFromImage');
        expect($content)->toContain('class StopDetection');
        expect($content)->toContain('class GetStatus');
    });
});

describe('PHP Classes', function () {
    it('has service provider', function () {
        $file = $this->pluginPath.'/src/MobileMlkitServiceProvider.php';
        expect(file_exists($file))->toBeTrue();
    });

    it('has facade', function () {
        $file = $this->pluginPath.'/src/Facades/MobileMlkit.php';
        expect(file_exists($file))->toBeTrue();
    });

    it('has main implementation class', function () {
        $file = $this->pluginPath.'/src/MobileMlkit.php';
        expect(file_exists($file))->toBeTrue();
    });

    it('has SharkToothDetected event', function () {
        $file = $this->pluginPath.'/src/Events/SharkToothDetected.php';
        expect(file_exists($file))->toBeTrue();
    });

    it('has DetectionCompleted event', function () {
        $file = $this->pluginPath.'/src/Events/DetectionCompleted.php';
        expect(file_exists($file))->toBeTrue();
    });

    it('has ModelLoaded event', function () {
        $file = $this->pluginPath.'/src/Events/ModelLoaded.php';
        expect(file_exists($file))->toBeTrue();
    });

    it('has CopyAssetsCommand', function () {
        $file = $this->pluginPath.'/src/Commands/CopyAssetsCommand.php';
        expect(file_exists($file))->toBeTrue();
    });
});

describe('Composer Configuration', function () {
    it('has valid composer.json', function () {
        $composerPath = $this->pluginPath.'/composer.json';
        expect(file_exists($composerPath))->toBeTrue();

        $content = file_get_contents($composerPath);
        $composer = json_decode($content, true);

        expect(json_last_error())->toBe(JSON_ERROR_NONE);
        expect($composer['type'])->toBe('nativephp-plugin');
    });

    it('has correct package name', function () {
        $composerPath = $this->pluginPath.'/composer.json';
        $composer = json_decode(file_get_contents($composerPath), true);

        expect($composer['name'])->toBe('nativephp/mobile-mlkit');
    });

    it('has correct autoload namespace', function () {
        $composerPath = $this->pluginPath.'/composer.json';
        $composer = json_decode(file_get_contents($composerPath), true);

        expect($composer['autoload']['psr-4'])->toHaveKey('NativePHP\\MobileMlkit\\');
    });

    it('registers service provider in Laravel', function () {
        $composerPath = $this->pluginPath.'/composer.json';
        $composer = json_decode(file_get_contents($composerPath), true);

        expect($composer['extra']['laravel']['providers'])
            ->toContain('NativePHP\\MobileMlkit\\MobileMlkitServiceProvider');
    });
});

describe('Documentation', function () {
    it('has README.md', function () {
        $file = $this->pluginPath.'/README.md';
        expect(file_exists($file))->toBeTrue();
    });

    it('has Boost guidelines', function () {
        $file = $this->pluginPath.'/resources/boost/guidelines/core.blade.php';
        expect(file_exists($file))->toBeTrue();
    });
});
