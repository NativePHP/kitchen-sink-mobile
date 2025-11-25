<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Geolocation\LocationReceived;
use Native\Mobile\Events\Geolocation\PermissionRequestResult;
use Native\Mobile\Events\Geolocation\PermissionStatusReceived;
use Native\Mobile\Facades\Geolocation as GeolocationFacade;

class Geolocation extends Component
{
    use HasQuote;
    public string $result = '';

    public function checkPermissions()
    {
        $this->result = 'Checking permissions...';
        GeolocationFacade::checkPermissions();
    }

    public function requestPermission()
    {
        $this->result = 'Requesting permissions...';
        GeolocationFacade::requestPermissions();
    }

    public function getLocation()
    {
        $this->result = 'Getting location...';
        GeolocationFacade::getCurrentPosition(true);
    }

    #[OnNative(PermissionStatusReceived::class)]
    public function handlePermissionStatus($location, $coarseLocation, $fineLocation)
    {
        $this->result = 'Permission Status: Location='.$location.', Coarse='.$coarseLocation.', Fine='.$fineLocation;
    }

    #[OnNative(PermissionRequestResult::class)]
    public function handlePermissionRequest($location, $coarseLocation, $fineLocation, $message = null, $needsSettings = null)
    {
        if ($location === 'permanently_denied') {
            $this->result = 'Permissions permanently denied. '.($message ?? 'Please enable location in Settings.');
        } else {
            $this->result = 'Permission Request Result: Location='.$location.', Coarse='.$coarseLocation.', Fine='.$fineLocation;
        }
    }

    #[OnNative(LocationReceived::class)]
    public function handleLocationReceived($success = null, $latitude = null, $longitude = null, $accuracy = null, $timestamp = null, $provider = null, $error = null)
    {
        if ($success) {
            $this->result = 'Location: '.$latitude.', '.$longitude.' (±'.$accuracy.'m) via '.$provider;
        } else {
            $this->result = 'Location Error: '.($error ?? 'Unknown error');
        }
    }

    public function render()
    {
        return view('livewire.geolocation')
            ->layout('components.layouts.app', [
                'title' => 'Geolocation',
            ]);
    }
}
