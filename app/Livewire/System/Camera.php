<?php

namespace App\Livewire\System;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Facades\System;

class Camera extends Component
{
    public string $photoDataUrl = '';

    public function camera()
    {
       System::camera();
    }

    #[On('native:camera')]
    public function handleCamera($payload)
    {
        $data   = base64_encode(file_get_contents($payload['photoPath']));
        $mime   = mime_content_type($payload['photoPath']);

        $this->photoDataUrl = "data:$mime;base64,$data";
    }

    public function render()
    {
        return view('livewire.system.camera');
    }
}
