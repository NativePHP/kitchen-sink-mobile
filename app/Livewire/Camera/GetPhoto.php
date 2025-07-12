<?php

namespace App\Livewire\Camera;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Facades\Camera as CameraFacade;

class GetPhoto extends Component
{
    public string $photoDataUrl = '';

    public function camera()
    {
        CameraFacade::getPhoto();
    }

    #[On('native:'.PhotoTaken::class)]
    public function handleCamera($path)
    {
        $data = base64_encode(file_get_contents($path));
        $mime = mime_content_type($path);

        $this->photoDataUrl = "data:$mime;base64,$data";
    }

    public function render()
    {
        return view('livewire.camera.get-photo');
    }
}
