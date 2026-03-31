<?php

namespace App\Livewire;

use App\Jobs\QueueSleep;
use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Facades\Dialog;

class SleepDemo extends Component
{
    use HasQuote;

    public function justSleep(): void
    {
        Dialog::toast('About to sleep for 5 seconds');
        sleep(5);
        Dialog::toast('We are done sleeping');
    }

    public function queueSleep(): void
    {
        Dialog::toast('About to sleep ON QUEUE for 5 seconds');
        dispatch(new QueueSleep());
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.sleep-demo')
            ->layout('components.layouts.app', [
                'title' => 'Sleep Demo',
            ]);
    }
}
