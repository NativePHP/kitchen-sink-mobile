<?php

namespace App\Livewire\Camera;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Facades\Camera as CameraFacade;
use Native\Mobile\Facades\File;

class GetPhoto extends Component
{
    public string $photoDataUrl = '';

    public function camera()
    {
        CameraFacade::getPhoto();
    }

    #[OnNative(PhotoTaken::class)]
    public function handleCamera($path)
    {
        $filename = 'photos/photo_'.time().'.jpg';

        File::move($path, Storage::disk('public')->path($filename));

        $this->photoDataUrl = Storage::disk('public')->url($filename);
    }

    public function render()
    {
        return view('livewire.camera.get-photo')
            ->layout('components.layouts.app', [
                'title' => 'Camera',
            ]);
    }
}
