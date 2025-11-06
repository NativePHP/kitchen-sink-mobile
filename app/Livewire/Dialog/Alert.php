<?php

namespace App\Livewire\Dialog;

use App\Events\CustomAlertEvent;
use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Alert\ButtonPressed;
use Native\Mobile\Facades\Audio;
use Native\Mobile\Facades\Dialog;

class Alert extends Component
{
    public function alert()
    {
        Dialog::alert('Alert', 'Is NativePHP the BEST way to build native mobile apps with PHP?', [
            'Yup ✅',
            'No Way! ⛔',
            "It's the best 😎!",
        ])->id('alert-demo');
    }

    #[On('native:'.ButtonPressed::class)]
    public function handleAlert($index, $label, $id)
    {
        if ($id !== 'alert-demo') {
            return;
        }

        if ($index == 1) {
            Dialog::toast('I know you meant to say yes 🤘');
        } else {
            Dialog::toast('You pressed "'.$label.'".');
        }
    }

    public function alertWithCustomEvent()
    {
        Dialog::alert('Alert', 'Is NativePHP the BEST way to build native mobile apps with PHP?', [
            'Yup ✅',
            'No Way! ⛔',
            "It's the best 😎!",
        ])->event(CustomAlertEvent::class);
    }

    #[On('native:'.CustomAlertEvent::class)]
    public function handleCustomEvent($index, $label)
    {
        if ($index == 0) {
            Dialog::toast('You rock! 🤘 🎸');
        } else {
            Dialog::toast('You pressed "'.$label.'" to be alerted.');
        }

    }

    public function render()
    {
        return view('livewire.dialog.alert')
            ->layout('components.layouts.app', [
                'title' => 'Alert Dialog'
            ]);
    }
}
