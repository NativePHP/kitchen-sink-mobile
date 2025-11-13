<?php

namespace App\Livewire\Audio;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Audio\AudioRecorded;
use Native\Mobile\Facades\Audio;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\Share;

class Demo extends Component
{
    public $recording;

    public $sharePath;

    public function recordAudio()
    {
        Audio::record();
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

    #[On('native:'.AudioRecorded::class)]
    public function handleAudioRecorded($path, $mimeType = null, $id = null)
    {
        $filename = 'audio/recording_'.time().'.m4a';
        $this->sharePath = $filename;
        Storage::disk('public')->put($filename, file_get_contents($path));
        $this->recording = Storage::disk('public')->url($filename);
    }

    public function share()
    {
        Share::file('Check this out!', 'Check this out!', Storage::disk('public')->path($this->sharePath));
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
                'trace' => $e->getTraceAsString()
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
