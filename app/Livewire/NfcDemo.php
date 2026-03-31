<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Events\Nfc\NfcError;
use Native\Mobile\Events\Nfc\ScanCancelled;
use Native\Mobile\Events\Nfc\TagRead;
use Native\Mobile\Events\Nfc\TagWritten;
use Native\Mobile\Facades\Dialog;
use Native\Mobile\Facades\Nfc;

class NfcDemo extends Component
{
    use HasQuote;

    public bool $available = false;

    public bool $enabled = false;

    public array $records = [];

    public ?string $tagId = null;

    public string $writeType = 'text';

    public string $writeContent = '';

    public ?string $lastError = null;

    public bool $written = false;

    public function mount(): void
    {
        if (function_exists('nativephp_call')) {
            $this->available = Nfc::isAvailable();
            $this->enabled = $this->available;
        }
    }

    public function readTag(): void
    {
        $this->reset(['records', 'tagId', 'lastError']);

        Nfc::read([
            'prompt' => 'Hold your device near the NFC tag',
        ]);
    }

    public function writeTag(): void
    {
        $this->reset(['lastError', 'written']);

        Nfc::write($this->writeType, $this->writeContent, [
            'prompt' => 'Hold your device near the NFC tag to write',
        ]);
    }

    #[OnNative(TagRead::class)]
    public function handleTagRead($records, $tagId = null, $id = null): void
    {
        $this->records = $records;
        $this->tagId = $tagId;
    }

    #[OnNative(TagWritten::class)]
    public function handleTagWritten($success, $id = null): void
    {
        $this->written = $success;
        Dialog::toast('Tag written successfully!');
    }

    #[OnNative(ScanCancelled::class)]
    public function handleScanCancelled($id = null): void
    {
        Dialog::toast('NFC scan cancelled');
    }

    #[OnNative(NfcError::class)]
    public function handleNfcError($message, $code = null, $id = null): void
    {
        $this->lastError = $message;
    }

    public function clearResults(): void
    {
        $this->reset(['records', 'tagId', 'lastError', 'written']);
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.nfc-demo')
            ->layout('components.layouts.app', [
                'title' => 'NFC',
            ]);
    }
}
