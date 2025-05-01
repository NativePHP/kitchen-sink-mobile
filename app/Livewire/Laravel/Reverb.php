<?php

namespace App\Livewire\Laravel;

use App\Events\MessageSent;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Facades\System;

class Reverb extends Component
{
    public array $messages = [];
    public string $message = '';

    public function send()
    {
        $this->messages[] = [
            'from' => 'self',
            'message' => $this->message,
        ];
        broadcast(new MessageSent($this->message, session()->get('user.name')))->toOthers();
        $this->reset('message');
    }

    #[On('echo:android,MessageSent')]
    public function messageReceived($message)
    {
        $this->messages[] = [
            'from' => 'other',
            'message' => $message['message'],
            'user' => $message['user'],
        ];
        System::vibrate();
    }

    public function render()
    {
        return view('livewire.laravel.reverb');
    }
}
