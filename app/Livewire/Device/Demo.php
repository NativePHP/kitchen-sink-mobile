<?php

namespace App\Livewire\Device;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Native\Mobile\Facades\Device;

class Demo extends Component
{
    public string $device_id = '';
    public string $device_info = '';

    public function mount()
    {
        $this->device_id = Device::getId();
        $this->device_info = Device::getInfo();
    }

    #[Computed]
    public function battery_info()
    {
        return Device::getBatteryInfo();
    }

    public function render()
    {
        return view('livewire.device.demo');
    }
}
