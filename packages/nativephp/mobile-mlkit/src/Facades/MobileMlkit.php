<?php

namespace NativePHP\MobileMlkit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static object|null loadModel(string $modelPath, array $options = [])
 * @method static object|null detectFromCamera(array $options = [])
 * @method static array|null detectFromImage(string $imagePath, array $options = [])
 * @method static bool stopDetection()
 * @method static object|null getStatus()
 *
 * @see \NativePHP\MobileMlkit\MobileMlkit
 */
class MobileMlkit extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \NativePHP\MobileMlkit\MobileMlkit::class;
    }
}
