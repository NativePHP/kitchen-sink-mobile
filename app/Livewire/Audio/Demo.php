<?php

namespace App\Livewire\Audio;

use App\Events\MyAudioRecordedEvent;
use App\Livewire\NativeEdge;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Facades\Audio;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\Share;
use Native\Mobile\Facades\File;

class Demo extends Component
{
    public string $currentlyPlayingPath = '';

    public function recordAudio()
    {
        Audio::record()
            ->event(MyAudioRecordedEvent::class)
            ->start();
    }

    public function pauseAudio()
    {
        Audio::pause();
    }

    public function stopAudio()
    {
        Audio::stop();
    }

    public function resumeAudio()
    {
        Audio::resume();
    }

    #[On('native:' . MyAudioRecordedEvent::class)]
    public function handleAudioRecorded($path, $mimeType = null, $id = null)
    {
        $filename = 'audio/recording_' . time() . '_' . uniqid() . '.m4a';
        File::move($path, Storage::disk('public')->path($filename));
        Dialog::toast('Audio recorded successfully!');
        $this->dispatch('media-recorded')->to(NativeEdge::class);
    }

    #[Computed]
    public function audioFiles()
    {
        $files = Storage::disk('public')->files('audio');

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
    public function playAudio(string $path): void
    {
        $this->currentlyPlayingPath = $path;
    }

    #[On('media-share')]
    public function shareAudio(string $path): void
    {
        Share::file('@nativephp #forever', '@nativephp #forever', Storage::disk('public')->path($path));
    }

    #[On('media-delete')]
    public function deleteAudio(string $path): void
    {
        if ($this->currentlyPlayingPath === $path) {
            $this->currentlyPlayingPath = '';
        }

        Storage::disk('public')->delete($path);
        Dialog::toast('Audio deleted successfully');
    }

    #[Computed]
    public function audioStatus()
    {
        try {
            $status = Audio::getStatus();

            return $status;
        } catch (\Exception $e) {
            logger('audioStatus() exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return 'error: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.audio.demo')
            ->layout('components.layouts.app', [
                'title' => 'Audio',
            ]);
    }
}
