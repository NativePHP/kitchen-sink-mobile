<?php

namespace App\Livewire\Camera;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\File;

class PickImages extends Component
{
    public array $photos = [];

    public array $videos = [];

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
                $this->toast('Videos are not supported yet');
            } else {
                // Save photos to storage like camera photos
                $filename = 'photos/photo_'.time().'_'.uniqid().'.jpg';

                File::move($file['path'], Storage::disk('public')->path($filename));

                $this->photos[] = Storage::disk('public')->url($filename);
            }
        }

        if (count($this->photos) > 0) {
            Dialog::toast(count($this->photos) > 1 ? 'Images selected successfully!' : 'Image selected successfully!');
        }
    }

    public function toast()
    {
        Dialog::toast('Currently only images are supported');
    }

    public function render()
    {
        return view('livewire.camera.pick-images')
            ->layout('components.layouts.app', [
                'title' => 'Camera',
            ]);
    }
}
