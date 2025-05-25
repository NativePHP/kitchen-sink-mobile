<?php

namespace App\Livewire\System;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\System;

class Camera extends Component
{
    public string $photoDataUrl = '';

    public function camera()
    {
       System::camera();
    }

    #[On('native:'.PhotoTaken::class)]
    public function handleCamera($path)
    {
        $data   = base64_encode(file_get_contents($path));
        $mime   = mime_content_type($path);

        $this->photoDataUrl = "data:$mime;base64,$data";
    }


    public function render()
    {
        return view('livewire.system.camera');
    }
}
