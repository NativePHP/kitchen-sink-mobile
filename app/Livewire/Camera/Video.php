<?php

namespace App\Livewire\Camera;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Camera\VideoCancelled;
use Native\Mobile\Events\Camera\VideoRecorded;
use Native\Mobile\Facades\Camera as CameraFacade;
use Native\Mobile\Facades\Dialog;

class Video extends Component
{
    public string $videoUrl = '';

    public bool $showVideoModal = false;

    public ?int $maxDuration = null;

    public function recordVideo()
    {
        CameraFacade::recordVideo([
            'maxDuration' => $this->maxDuration,
        ]);
    }

    #[On('native:'.VideoRecorded::class)]
    public function handleVideoRecorded($path)
    {
        // Copy video to public storage
        $filename = 'video_'.time().'.mp4';
        $publicPath = public_path('videos/'.$filename);

        // Ensure videos directory exists
        if (!file_exists(public_path('videos'))) {
            mkdir(public_path('videos'), 0755, true);
        }

        // Copy the video file
        copy($path, $publicPath);

        // Set the URL using asset() helper
        $this->videoUrl = asset('videos/'.$filename);

        // Show the modal
        $this->showVideoModal = true;
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
