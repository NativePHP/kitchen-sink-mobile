<?php

namespace App\Livewire;

use Livewire\Component;
use Native\Mobile\Facades\Network as NetworkFacade;

class Network extends Component
{
    public $status = '';

    public $connected = false;

    public $isExpensive = false;

    public $isConstrained = false;

    public function mount()
    {
        $this->getNetwork();
    }

    public function getNetwork()
    {
        $this->reset();
        $status = NetworkFacade::status();

        if ($status->connected) {
            $this->connected = true;
            $this->status = $status->type;

            if ($status->isExpensive) {
                $this->isExpensive = true;
            }

            if ($status->isConstrained) {
                $this->isConstrained = true;
            }
        } else {
            $this->status = 'Disconnected';
        }

    }

    public function render()
    {
        return view('livewire.network')
            ->layout('components.layouts.app', [
                'title' => 'Network',
            ]);
    }
}
