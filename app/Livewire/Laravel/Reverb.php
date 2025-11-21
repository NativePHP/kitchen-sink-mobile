<?php

namespace App\Livewire\Laravel;

use App\Events\MessageSent;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
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
        broadcast(new MessageSent($this->message, 'test'))->toOthers();
        $this->reset('message');
    }

    #[OnNative('echo:android,MessageSent')]
    public function messageReceived($message)
    {
        $this->messages[] = [
            'from' => 'other',
            'message' => $message['message'],
            'user' => 'test',
        ];
        System::vibrate();
    }

    public function render()
    {
        return view('livewire.laravel.reverb')
            ->layout('components.layouts.app', [
                'title' => 'Laravel Reverb',
            ]);
    }
}
