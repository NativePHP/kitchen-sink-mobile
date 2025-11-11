<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.qr-code variant="mini" class="mr-2"/>
            QR Code Scanner
        </flux:heading>

        <flux:subheading>
            <p>Configure your scanner settings and press scan to begin.</p>
        </flux:subheading>
    </flux:card>

    <flux:card>
        <div class="space-y-4">
            <flux:field class="my-2">
                <flux:switch label="Continuous Scanning" wire:model.live="streaming" />
                <flux:text size="sm" class="text-zinc-600 dark:text-zinc-400">
                    Enable to scan multiple codes in succession
                </flux:text>
            </flux:field>
            <flux:field>
                <flux:label>Format</flux:label>
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
            </flux:field>

            <flux:button variant="filled" icon="qr-code" wire:click="scan" class="w-full">
                {{ $streaming ? 'Start Continuous Scan' : 'Scan Code' }}
            </flux:button>
        </div>
    </flux:card>

    @if($streaming && count($scanned) > 0)
        <flux:card>
            <div class="flex items-center justify-between mb-4">
                <flux:heading size="md">Scanned Codes ({{ count($scanned) }})</flux:heading>
                <flux:button variant="ghost" size="sm" wire:click="clearScans" icon="x-mark">
                    Clear
                </flux:button>
            </div>

            <div class="space-y-2">
                @foreach($scanned as $index => $scan)
                    <div wire:key="scan-{{ $index }}" class="p-4 rounded-lg bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <flux:badge size="sm" color="blue">{{ strtoupper(str_replace('_', ' ', $scan['format'])) }}</flux:badge>
                                    <flux:text size="xs" class="text-zinc-500 dark:text-zinc-400">{{ $scan['timestamp'] }}</flux:text>
                                </div>
                                <flux:text class="font-mono break-all">{{ $scan['data'] }}</flux:text>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </flux:card>
    @endif

    @if(!$streaming && $data)
        <flux:card>
            <flux:heading size="md" class="mb-4">Scan Result</flux:heading>

            <div class="space-y-4">
                <div>
                    <flux:label>Format</flux:label>
                    <div class="mt-1">
                        <flux:badge color="blue">{{ strtoupper(str_replace('_', ' ', $format)) }}</flux:badge>
                    </div>
                </div>

                <div>
                    <flux:label>Data</flux:label>
                    <div class="mt-1 p-4 rounded-lg bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                        <flux:text class="font-mono break-all">{{ $data }}</flux:text>
                    </div>
                </div>

                <flux:button variant="ghost" wire:click="clearScans" icon="x-mark" class="w-full">
                    Clear Result
                </flux:button>
            </div>
        </flux:card>
    @endif
</div>
