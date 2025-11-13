<?php

namespace App\Livewire\Camera;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Camera\VideoCancelled;
use Native\Mobile\Events\Camera\VideoRecorded;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;

class Video extends Component
{
    public string $videoUrl = '';

    public string $sharePath = '';

    public bool $showVideoModal = false;

    public ?int $maxDuration = null;

    public function recordVideo()
    {
        $recorder = Camera::recordVideo();

        if ($this->maxDuration) {
            $recorder->maxDuration($this->maxDuration);
        }
    }

    #[On('native:'.VideoRecorded::class)]
    public function handleVideoRecorded($path, $mimeType = null, $id = null)
    {
        $this->sharePath = $path;
        $filename = 'videos/video_'.time().'.mp4';

        // Store video using Laravel Storage
        Storage::disk('public')->put($filename, file_get_contents($path));

        // Generate public URL and path
        $this->videoUrl = Storage::disk('public')->url($filename);

        // Show the modal
        $this->showVideoModal = true;
    }

    public function share()
    {
        Dialog::shareFile('My Video Note', 'I shared this NATIVELY with PHP!', $this->sharePath);
    }

    #[On('native:'.VideoCancelled::class)]
    public function handleVideoCancelled()
    {
        Dialog::toast('Video recording cancelled');
    }

    public function render()
    {
        return view('livewire.camera.video')
            ->layout('components.layouts.app', [
                'title' => 'Video Recorder',
            ]);
    }
}
