<?php

namespace App\Livewire\SecureStorage;

use Livewire\Component;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\SecureStorage;

class Demo extends Component
{
    public $key = '';

    public $value = '';

    public $retrieveKey = '';

    public $retrievedValue = '';

    public $deleteKey = '';

    public function setSecureValue()
    {
        if (empty($this->key) || empty($this->value)) {
            Dialog::alert('Attention!', 'Please provide both key and value');

            return;
        }

        try {
            SecureStorage::set($this->key, $this->value);
            Dialog::alert('Stored!', "Successfully stored value for key: {$this->key}");
            $this->reset(['key', 'value']);
        } catch (\Exception $e) {
            Dialog::alert('Error', "Error storing value: {$e->getMessage()}");
        }
    }

    public function getSecureValue()
    {
        if (empty($this->retrieveKey)) {
            Dialog::alert('Attention!', 'Please provide a key to retrieve');

            return;
        }

        try {
            $this->retrievedValue = SecureStorage::get($this->retrieveKey);
            $this->retrievedValue
                ? Dialog::alert('Decrypted', "Successfully retrieved value for {$this->retrieveKey}: {$this->retrievedValue}")
                : Dialog::alert("Error retrieving '{$this->retrieveKey}'", 'No value found.');
        } catch (\Exception $e) {
            Dialog::alert('Error', "Error retrieving value: {$e->getMessage()}");
            $this->retrievedValue = '';
        }
    }

    public function deleteSecureValue()
    {
        if (empty($this->deleteKey)) {
            Dialog::alert('Attention!', 'Please provide a key to delete');

            return;
        }

        try {
            SecureStorage::Set($this->deleteKey, null);
            Dialog::alert('Success', "Successfully deleted value for key: {$this->deleteKey}");
            $this->reset(['deleteKey']);
        } catch (\Exception $e) {
            Dialog::alert('Error', "Error deleting value: {$e->getMessage()}");
        }
    }

    public function render()
    {
        return view('livewire.secure-storage.demo');
    }
}
