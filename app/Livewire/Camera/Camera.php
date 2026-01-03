<?php

namespace App\Livewire\Camera;

use App\Livewire\Concerns\HasQuote;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Facades\Camera as CameraFacade;
use Native\Mobile\Facades\File;

class Camera extends Component
{
    use HasQuote;

    public string $photoDataUrl = '';

    public function camera()
    {
        CameraFacade::getPhoto();
    }

    #[OnNative(PhotoTaken::class)]
    public function handleCamera($path)
    {
        $filename = 'photos/photo_'.time().'.jpg';

        File::move($path, Storage::path($filename));

        $this->photoDataUrl = Storage::url($filename);
    }

    public function render()
    {
        return view('livewire.camera.camera')
            ->layout('components.layouts.app', [
                'title' => 'Camera',
            ]);
    }
}
