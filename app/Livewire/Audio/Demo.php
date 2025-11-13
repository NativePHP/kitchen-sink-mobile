<?php

namespace App\Livewire\Audio;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Audio\AudioRecorded;
use Native\Mobile\Facades\Audio;
use Native\Mobile\Facades\Dialog;

class Demo extends Component
{
    public $recording;

    public $sharePath;

    public $recordingStartTime;

    public $pausedElapsedTime = 0;

    public function recordAudio()
    {
        Audio::record();
        $this->recordingStartTime = time();
        $this->pausedElapsedTime = 0;
    }

    public function pauseAudio()
    {
        Audio::pause();
        // Store the elapsed time when pausing
        if ($this->recordingStartTime) {
            $this->pausedElapsedTime = time() - $this->recordingStartTime;
        }
    }

    public function stopAudio()
    {
        Audio::stop();
        $this->recordingStartTime = null;
        $this->pausedElapsedTime = 0;
    }

    #[On('native:'.AudioRecorded::class)]
    public function handleAudioRecorded($path, $mimeType = null, $id = null)
    {
        $this->sharePath = $path;
        $filename = 'audio/recording_'.time().'.m4a';
        Storage::disk('public')->put($filename, file_get_contents($path));
        $this->recording = Storage::disk('public')->url($filename);
    }

    public function resumeAudio()
    {
        Audio::resume();
        // Adjust start time to account for already elapsed time
        $this->recordingStartTime = time() - $this->pausedElapsedTime;
    }

    public function share()
    {
        Dialog::shareFile('My Voice Note', 'I shared this NATIVELY with PHP!', $this->sharePath);
    }

    #[Computed]
    public function audioStatus()
    {
        try {
            $status = Audio::getStatus();
            \Log::debug('audioStatus()', ['status' => $status]);
            return $status;
        } catch (\Exception $e) {
            \Log::error('audioStatus() exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 'error: ' . $e->getMessage();
        }
    }

    #[Computed]
    public function recordingDuration()
    {
        if (! $this->recordingStartTime) {
            return '00:00';
        }

        // If paused, use the stored elapsed time
        if ($this->audioStatus() === 'paused') {
            $seconds = $this->pausedElapsedTime;
        } else {
            $seconds = time() - $this->recordingStartTime;
        }

        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;

        return sprintf('%02d:%02d', $minutes, $remainingSeconds);
    }

    public function render()
    {
        return view('livewire.audio.demo')
            ->layout('components.layouts.app', [
                'title' => 'Audio',
            ]);
    }
}
