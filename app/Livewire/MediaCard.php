<?php

namespace App\Livewire;

use Livewire\Component;

class MediaCard extends Component
{
    public array $media;

    public string $type = 'audio';

    public bool $showButtons = true;

    public function play(): void
    {
        $this->dispatch('media-play', path: $this->media['path']);
    }

    public function share(): void
    {
        $this->dispatch('media-share', path: $this->media['path']);
    }

    public function delete(): void
    {
        $this->dispatch('media-delete', path: $this->media['path']);
        $this->dispatch('media-delete')->to(NativeEdge::class);
    }

    public function render()
    {
        return view('livewire.media-card');
    }
}
