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
    <flux:select wire:model="requestedFormat" placeholder="Choose format...">
        <flux:select.option>qr_code</flux:select.option>
        <flux:select.option>ean_13</flux:select.option>
        <flux:select.option>ean_8</flux:select.option>
        <flux:select.option>code_128</flux:select.option>
        <flux:select.option>code_39</flux:select.option>
        <flux:select.option>upca</flux:select.option>
        <flux:select.option>upce</flux:select.option>
        <flux:select.option>data_matrix</flux:select.option>
        <flux:select.option>pdf417</flux:select.option>
        <flux:select.option>aztec</flux:select.option>
        <flux:select.option>codabar</flux:select.option>
        <flux:select.option>itf</flux:select.option>
        <flux:select.option>all</flux:select.option>
    </flux:select>
    <flux:button variant="filled" icon="qr-code" wire:click="scan" class="w-full">Scan</flux:button>
    @if($data)
        <p>Data: {{$data}}</p>
        <p>Format: {{$format}}</p>
    @endif
</div>
