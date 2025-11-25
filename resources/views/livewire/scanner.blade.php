<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-indigo-500 to-blue-500 dark:from-indigo-600 dark:to-blue-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Scanner
                    </h1>
                    <p class="text-lg text-white">
                        Scan QR codes and barcodes with lightning speed and precision!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Scanner Settings Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <div class="space-y-4">
                <div class="flex items-center justify-between space-x-2 p-4 rounded-lg bg-gradient-to-r from-purple-100 to-indigo-100 dark:from-purple-900/30 dark:to-indigo-900/30 border-2 border-purple-200 dark:border-purple-700">
                    <div class="space-y-0.5">
                        <flux:label class="text-base font-semibold">Continuous Scanning</flux:label>
                        <div class="text-sm text-muted-foreground">
                            Enable to scan multiple codes in succession
                        </div>
                    </div>
                    <flux:switch wire:model.live="streaming" />
                </div>

                <div class="space-y-2">
                    <flux:label class="text-base font-semibold">Format</flux:label>
                    <flux:select wire:model="requestedFormat" placeholder="Choose format..." >
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
                </div>

                <flux:button
                    wire:click="scan"
                    icon="qr-code"
                    class="py-6 w-full bg-gradient-to-br from-indigo-500 to-blue-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                >
                    {{ $streaming ? 'Start Continuous Scan' : 'Scan Code' }}
                </flux:button>
            </div>
        </flux:card>

        <!-- Scanned Codes List (Continuous Mode) -->
        @if($streaming && count($scanned) > 0)
            <flux:card class="bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700">
                <div class="flex items-center justify-between mb-4">
                    <flux:heading size="md" icon="qr-code" class="text-green-900 dark:text-green-100">
                        Scanned Codes ({{ count($scanned) }})
                    </flux:heading>
                    <flux:button size="sm" wire:click="clearScans" icon="x-mark" class="bg-gradient-to-r from-red-500 to-pink-500 !text-white border-0 [&>span]:!text-white">
                        Clear
                    </flux:button>
                </div>

                <div class="space-y-2">
                    @foreach($scanned as $index => $scan)
                        <div wire:key="scan-{{ $index }}" class="p-4 rounded-lg bg-white/50 dark:bg-gray-800/50 border-2 border-white/50 backdrop-blur-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <flux:badge class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white border-0">{{ strtoupper(str_replace('_', ' ', $scan['format'])) }}</flux:badge>
                                        <span class="text-xs text-muted-foreground font-semibold">{{ $scan['timestamp'] }}</span>
                                    </div>
                                    <div class="font-mono text-sm break-all font-semibold">{{ $scan['data'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </flux:card>
        @endif

        <!-- Single Scan Result -->
        @if(!$streaming && $data)
            <flux:card class="bg-gradient-to-br from-amber-100 to-yellow-100 dark:from-amber-900/30 dark:to-yellow-900/30 border-2 border-amber-200 dark:border-amber-700">
                <flux:heading size="md" icon="qr-code" class="text-amber-900 dark:text-amber-100 mb-4">
                    Scan Result
                </flux:heading>

                <div class="space-y-4">
                    <div>
                        <flux:label class="text-base font-semibold">Format</flux:label>
                        <div class="mt-1">
                            <flux:badge class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white border-0 text-base px-3 py-1">{{ strtoupper(str_replace('_', ' ', $format)) }}</flux:badge>
                        </div>
                    </div>

                    <div>
                        <flux:label class="text-base font-semibold">Data</flux:label>
                        <div class="mt-1 p-4 rounded-lg bg-white/50 dark:bg-gray-800/50 border-2 border-white/50 backdrop-blur-sm">
                            <div class="font-mono text-sm break-all font-semibold">{{ $data }}</div>
                        </div>
                    </div>

                    <flux:button wire:click="clearScans" icon="x-mark" class="w-full py-4 bg-gradient-to-r from-red-500 to-pink-500 !text-white border-0 text-xl [&>span]:!text-white">
                        Clear Result
                    </flux:button>
                </div>
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>
