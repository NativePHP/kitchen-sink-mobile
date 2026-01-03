<?php

namespace App\Livewire;

use App\Livewire\Concerns\HasQuote;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Native\Mobile\Attributes\OnNative;
use Nativephp\MobileWallet\Events\Wallet\PaymentCancelled;
use Nativephp\MobileWallet\Events\Wallet\PaymentCompleted;
use Nativephp\MobileWallet\Events\Wallet\PaymentFailed;
use Nativephp\MobileWallet\Facades\MobileWallet;

class Wallet extends Component
{
    use HasQuote;

    public bool $walletAvailable = false;

    public int $amount = 1000; // $10.00 in cents

    public string $status = 'idle'; // idle, processing, success, failed, cancelled

    public ?string $paymentIntentId = null;

    public ?string $errorMessage = null;

    public function mount(): void
    {
        $this->walletAvailable = MobileWallet::isAvailable();
    }

    public function pay(): void
    {
        $this->status = 'processing';
        $this->errorMessage = null;

        // Create PaymentIntent via backend
        $response = Http::post(url('/stripe/create-intent'), [
            'amount' => $this->amount,
            'currency' => 'usd',
        ]);

        if (! $response->successful()) {
            $this->status = 'failed';
            $this->errorMessage = 'Failed to create payment intent';

            return;
        }

        $data = $response->json();
        $clientSecret = $data['clientSecret'];
        $this->paymentIntentId = $data['paymentIntentId'];

        // Present native payment sheet
        MobileWallet::presentPaymentSheet(
            $clientSecret,
            'Demo Store',
            config('services.stripe.publishable'),
            config('services.stripe.apple_merchant_id')
        );
    }

    #[OnNative(PaymentCompleted::class)]
    public function handlePaymentCompleted($paymentIntentId, $status): void
    {
        $this->status = 'success';
        $this->paymentIntentId = $paymentIntentId;
    }

    #[OnNative(PaymentFailed::class)]
    public function handlePaymentFailed($paymentIntentId, $errorCode, $errorMessage): void
    {
        $this->status = 'failed';
        $this->paymentIntentId = $paymentIntentId;
        $this->errorMessage = $errorMessage;
    }

    #[OnNative(PaymentCancelled::class)]
    public function handlePaymentCancelled($paymentIntentId, $reason): void
    {
        $this->status = 'cancelled';
        $this->paymentIntentId = $paymentIntentId;
        $this->errorMessage = $reason ?? 'Payment was cancelled';
    }

    public function resetPayment(): void
    {
        $this->status = 'idle';
        $this->paymentIntentId = null;
        $this->errorMessage = null;
    }

    public function render()
    {
        return view('livewire.wallet')
            ->layout('components.layouts.app', [
                'title' => 'Wallet',
            ]);
    }
}
