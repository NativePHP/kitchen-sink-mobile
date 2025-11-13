<?php

namespace App\Livewire\Camera;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Facades\Camera as CameraFacade;

class GetPhoto extends Component
{
    public string $photoDataUrl = '';

    public function camera()
    {
        CameraFacade::getPhoto();
    }

    #[On('native:'.PhotoTaken::class)]
    public function handleCamera($path)
    {
        $filename = 'photos/photo_'.time().'.jpg';

        Storage::disk('public')->put($filename, file_get_contents($path));

        $this->photoDataUrl = Storage::disk('public')->url($filename);
    }

    public function render()
    {
        return view('livewire.camera.get-photo')
            ->layout('components.layouts.app', [
                'title' => 'Camera'
            ]);
    }
}
