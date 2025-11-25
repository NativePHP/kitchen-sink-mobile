<?php

namespace App\Livewire;

use App\Events\MyAudioRecordedEvent;
use App\Livewire\Concerns\HasQuote;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\File;
use Native\Mobile\Facades\Microphone as MicrophoneFacade;
use Native\Mobile\Facades\Share;

class Microphone extends Component
{
    use HasQuote;
    public string $currentlyPlayingPath = '';

    public function recordAudio()
    {
        MicrophoneFacade::record()
            ->event(MyAudioRecordedEvent::class)
            ->start();
    }

    public function pauseAudio()
    {
        MicrophoneFacade::pause();
    }

    public function stopAudio()
    {
        MicrophoneFacade::stop();
    }

    public function resumeAudio()
    {
        MicrophoneFacade::resume();
    }

    #[OnNative(MyAudioRecordedEvent::class)]
    public function handleAudioRecorded($path, $mimeType = null, $id = null)
    {
        $filename = 'audio/recording_'.time().'_'.uniqid().'.m4a';
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
            $status = MicrophoneFacade::getStatus();

            return $status;
        } catch (\Exception $e) {
            logger('audioStatus() exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return 'error: '.$e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.microphone')
            ->layout('components.layouts.app', [
                'title' => 'Microphone',
            ]);
    }
}
