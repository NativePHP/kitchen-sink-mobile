<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Native\Mobile\Facades\Device as DeviceFacade;

class Device extends Component
{
    public string $device_id = '';
    public string $device_info = '';

    public function mount()
    {
        $this->device_id = DeviceFacade::getId();
        $this->device_info = DeviceFacade::getInfo();
    }

    #[Computed]
    public function battery_info()
    {
        return DeviceFacade::getBatteryInfo();
    }

    public function render()
    {
        return view('livewire.device')
            ->layout('components.layouts.app', [
                'title' => 'Device Info'
            ]);
    }
}
