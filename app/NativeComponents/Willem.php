<?php

namespace App\NativeComponents;

use Native\Mobile\Edge\Element;
use Native\Mobile\Edge\NativeComponent;

class Willem extends NativeComponent
{
    public function render(): Element
    {
        return $this->view('willem');
    }
}