<div>
    <flux:callout >
        <flux:callout.heading icon="finger-print">Biometric Scanner!</flux:callout.heading>

        <flux:callout.text>
            Press the button below to request permission to use the biometric scanner.
        </flux:callout.text>
    </flux:callout>

    <flux:button wire:click="promptForBiometricID" icon="finger-print" class="w-full mt-8">Request Biometric ID</flux:button>
    <div class="w-full mt-8">
        @if ($secure)
            <flux:callout class="w-full" variant="success" icon="check-circle" heading="Your account is verified and ready to use." />
        @else
            <flux:callout class="w-full" variant="danger" icon="x-circle" heading="This is a SECURE AREA, please authenticate yourself to continue!" />
        @endif
    </div>
</div>
