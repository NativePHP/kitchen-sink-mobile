<?php

namespace App\Livewire\SecureStorage;

use Livewire\Component;
use Native\Mobile\Facades\SecureStorage;

class Demo extends Component
{
    public $key = '';
    public $value = '';
    public $retrieveKey = '';
    public $retrievedValue = '';
    public $deleteKey = '';
    public $message = '';

    public function setSecureValue()
    {
        if (empty($this->key) || empty($this->value)) {
            $this->message = 'Please provide both key and value';
            return;
        }

        try {
            SecureStorage::set($this->key, $this->value);
            $this->message = "Successfully stored value for key: {$this->key}";
            $this->reset(['key', 'value']);
        } catch (\Exception $e) {
            $this->message = "Error storing value: {$e->getMessage()}";
        }
    }

    public function getSecureValue()
    {
        if (empty($this->retrieveKey)) {
            $this->message = 'Please provide a key to retrieve';
            return;
        }

        try {
            $this->retrievedValue = SecureStorage::get($this->retrieveKey);
            $this->message = $this->retrievedValue
                ? "Successfully retrieved value for key: {$this->retrieveKey}"
                : "No value found for key: {$this->retrieveKey}";
        } catch (\Exception $e) {
            $this->message = "Error retrieving value: {$e->getMessage()}";
            $this->retrievedValue = '';
        }
    }

    public function deleteSecureValue()
    {
        if (empty($this->deleteKey)) {
            $this->message = 'Please provide a key to delete';
            return;
        }

        try {
            SecureStorage::set($this->deleteKey, null);
            $this->message = "Successfully deleted value for key: {$this->deleteKey}";
            $this->reset(['deleteKey']);
        } catch (\Exception $e) {
            $this->message = "Error deleting value: {$e->getMessage()}";
        }
    }

    public function clearMessage()
    {
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.secure-storage.demo');
    }
}
