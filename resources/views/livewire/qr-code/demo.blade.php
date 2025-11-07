<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.qr-code variant="mini" class="mr-2"/>
            QR Code
        </flux:heading>

        <flux:subheading >
            <p>Press the button below to scan a qr code.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="qr-code" wire:click="scan" class="w-full">Scan</flux:button>
    @if($data)
        <p>Data: {{$data}}</p>
        <p>Format: {{$format}}</p>
    @endif
</div>
