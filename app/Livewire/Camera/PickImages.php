<?php

namespace App\Livewire\Camera;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;

class PickImages extends Component
{
    public array $photos;

    public array $videos;

    public function gallery(string $media_type = 'all', bool $multiple = false, int $max_items = 5)
    {
        Camera::pickImages($media_type, $multiple, $max_items);
    }

    #[On('native:'.MediaSelected::class)]
    public function handleGallery($success, $files, $count)
    {
        $this->photos = [];
        $this->videos = [];

        foreach ($files as $file) {
            if ($file['type'] === 'video') {
                $this->toast();
                // For videos, encode the path and serve directly
                //                $encodedPath = base64_encode($file['path']);
                //                $this->videos[] = url("/video-direct/{$encodedPath}");
            } else {
                // For photos, use base64 data URI (small files)
                $data = base64_encode(file_get_contents($file['path']));
                $this->photos[] = "data:{$file['mimeType']};base64,{$data}";
            }
        }
    }

    public function toast()
    {
        Dialog::toast('Currently only images are supported');
    }

    public function render()
    {
        return view('livewire.camera.pick-images');
    }
}
