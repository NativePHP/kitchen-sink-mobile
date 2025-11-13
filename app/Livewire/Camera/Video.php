<?php

namespace App\Livewire\Camera;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Camera\VideoCancelled;
use Native\Mobile\Events\Camera\VideoRecorded;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\Share;

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
        $filename = 'videos/video_'.time().'.mp4';
        $this->sharePath = $filename;

        // Store video using Laravel Storage
        Storage::disk('public')->put($filename, file_get_contents($path));

        // Generate public URL and path
        $this->videoUrl = Storage::disk('public')->url($filename);

        // Show the modal
        $this->showVideoModal = true;
    }

    public function share()
    {
        Share::file('Check this out!', 'Check this out!', Storage::disk('public')->path($this->sharePath));
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
