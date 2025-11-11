<?php

namespace App\Livewire\Audio;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Native\Mobile\Facades\Audio;

class Demo extends Component
{
    public $recording;

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
        $this->recording = Audio::stop();
        $this->recordingStartTime = null;
        $this->pausedElapsedTime = 0;
    }

    public function resumeAudio()
    {
        Audio::resume();
        // Adjust start time to account for already elapsed time
        $this->recordingStartTime = time() - $this->pausedElapsedTime;
    }

    #[Computed]
    public function audioStatus()
    {
        return Audio::getStatus();
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
