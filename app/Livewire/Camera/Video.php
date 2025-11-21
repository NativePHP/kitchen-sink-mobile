<?php

namespace App\Livewire\Camera;

use App\Livewire\NativeEdge;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Camera\VideoCancelled;
use Native\Mobile\Events\Camera\VideoRecorded;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\File;
use Native\Mobile\Facades\Share;

class Video extends Component
{
    public string $currentlyPlayingPath = '';

    public ?int $maxDuration = null;

    public bool $processing = false;

    public function recordVideo()
    {
        $recorder = Camera::recordVideo();

        if ($this->maxDuration) {
            $recorder->maxDuration($this->maxDuration);
        }
    }

    #[OnNative(VideoRecorded::class)]
    public function handleVideoRecorded($path, $mimeType = null, $id = null)
    {
        $filename = 'videos/video_'.time().'_'.uniqid().'.mp4';
        File::move($path, Storage::disk('public')->path($filename));
        Dialog::toast('Video recorded successfully!');
        $this->dispatch('media-recorded')->to(NativeEdge::class);
    }

    #[Computed]
    public function videos()
    {
        $files = Storage::disk('public')->files('videos');

        return collect($files)->map(function ($file) {
            return [
                'path' => $file,
                'name' => basename($file),
                'size' => Storage::disk('public')->size($file),
                'url' => Storage::disk('public')->url($file),
                'date' => Storage::disk('public')->lastModified($file),
            ];
        })->sortByDesc('date')->values();
    }

    #[On('media-play')]
    public function playVideo(string $path): void
    {
        $this->currentlyPlayingPath = $path;
    }

    #[On('media-share')]
    public function shareVideo(string $path): void
    {
        Share::file('Check this out!', 'Check this out!', Storage::disk('public')->path($path));
    }

    #[On('media-delete')]
    public function deleteVideo(string $path): void
    {
        if ($this->currentlyPlayingPath === $path) {
            $this->currentlyPlayingPath = '';
        }

        Storage::disk('public')->delete($path);
        Dialog::toast('Video deleted successfully');
    }

    #[OnNative(VideoCancelled::class)]
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
