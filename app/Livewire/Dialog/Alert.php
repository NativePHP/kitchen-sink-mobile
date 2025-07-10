<?php

namespace App\Livewire\Dialog;

use Livewire\Attributes\On;
use Livewire\Component;
use Native\Mobile\Events\Alert\ButtonPressed;
use Native\Mobile\Facades\Dialog;

class Alert extends Component
{
    public function alert()
    {
        Dialog::alert('Alert', 'Is NativePHP the BEST way to build native mobile apps with PHP?', [
            'Yup ✅',
            'No Way! ⛔',
            "It's the best 😎!",
        ]);
    }


    #[On('native:' . ButtonPressed::class)]
    public function handleAlert($index, $label)
    {
        if($index == 1){
            Dialog::toast('I know you meant to say yes 🤘');
            Dialog::toast('Index: ' . $index);
        }else{
            Dialog::toast('You pressed "' . $label . '" to be alerted.');
            Dialog::toast('Index: ' . $index);
        }

    }
    public function render()
    {
        return view('livewire.dialog.alert');
    }
}
