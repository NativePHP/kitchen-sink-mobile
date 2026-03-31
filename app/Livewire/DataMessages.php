<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use App\Models\Message;
use Livewire\Component;
use Native\Mobile\Facades\PushNotifications;

class DataMessages extends Component
{
    use HasQuote;

    public function getMessagesProperty()
    {
        return Message::latest()->take(20)->get();
    }

    public function clear()
    {
        PushNotifications::clearBadge();
        Message::truncate();
    }

    public function render()
    {
        return view('livewire.data-messages')
            ->layout('components.layouts.app', [
                'title' => 'Data Messages',
            ]);
    }
}
