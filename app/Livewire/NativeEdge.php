<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class NativeEdge extends Component
{
    public string $title = 'Dashboard';

    public $audioCount = 0;

    public $videoCount = 0;

    public function mount()
    {
        $this->audioCount = collect(Storage::files('audio'))->count();
        $this->videoCount = collect(Storage::files('videos'))->count();
    }

    #[On('media-recorded')]
    #[On('media-delete')]
    public function refreshCounts(): void
    {
        $this->audioCount = collect(Storage::files('audio'))->count();
        $this->videoCount = collect(Storage::files('videos'))->count();
        logger(print_r($this, true));
    }

    public function render()
    {
        return view('livewire.native-edge');
    }
}
