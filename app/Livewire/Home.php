<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render(): \Illuminate\View\View
    {
        $featuredDemos = [
            [
                'title' => 'Camera',
                'icon' => 'camera',
                'route' => 'camera.camera',
                'gradient' => 'from-blue-500 to-cyan-500 dark:from-blue-400 dark:to-cyan-400',
            ],
            [
                'title' => 'Video',
                'icon' => 'video-camera',
                'route' => 'camera.video',
                'gradient' => 'from-red-500 to-pink-500 dark:from-red-400 dark:to-pink-400',
            ],
            [
                'title' => 'Gallery',
                'icon' => 'photo',
                'route' => 'camera.gallery',
                'gradient' => 'from-purple-500 to-violet-500 dark:from-purple-400 dark:to-violet-400',
            ],
            [
                'title' => 'Microphone',
                'icon' => 'speaker-wave',
                'route' => 'microphone',
                'gradient' => 'from-orange-500 to-amber-500 dark:from-orange-400 dark:to-amber-400',
            ],
            [
                'title' => 'Scanner',
                'icon' => 'qr-code',
                'route' => 'scanner',
                'gradient' => 'from-indigo-500 to-blue-500 dark:from-indigo-400 dark:to-blue-400',
            ],
            [
                'title' => 'Location',
                'icon' => 'map-pin',
                'route' => 'geolocation.getCurrent',
                'gradient' => 'from-green-500 to-emerald-500 dark:from-green-400 dark:to-emerald-400',
            ],
            [
                'title' => 'Biometrics',
                'icon' => 'finger-print',
                'route' => 'biometrics',
                'gradient' => 'from-teal-500 to-cyan-500 dark:from-teal-400 dark:to-cyan-400',
            ],
            [
                'title' => 'Info',
                'icon' => 'device-phone-mobile',
                'route' => 'device',
                'gradient' => 'from-slate-500 to-gray-500 dark:from-slate-400 dark:to-gray-400',
            ],
        ];

        return view('livewire.home', compact('featuredDemos'))
            ->layout('components.layouts.app', [
                'title' => 'Home',
            ]);
    }
}
