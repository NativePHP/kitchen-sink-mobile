<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-cyan-500 to-teal-500 dark:from-cyan-600 dark:to-teal-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        NFC
                    </h1>
                    <p class="text-lg text-white">
                        Read and write NFC tags with NDEF data — text, URLs, and more.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="space-y-4 px-4">
        <!-- Availability Status -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <div class="flex items-center justify-between">
                <div class="space-y-0.5">
                    <flux:label class="text-base font-semibold">NFC Status</flux:label>
                    <div class="text-sm text-muted-foreground">
                        {{ $available ? ($enabled ? 'NFC is available and enabled' : 'NFC hardware found but disabled') : 'NFC is not available on this device' }}
                    </div>
                </div>
                <flux:badge class="{{ $available && $enabled ? 'bg-green-500' : 'bg-red-500' }} text-white border-0">
                    {{ $available && $enabled ? 'Ready' : 'Unavailable' }}
                </flux:badge>
            </div>
        </flux:card>

        <!-- Read Section -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <div class="space-y-4">
                <flux:heading size="md">Read Tag</flux:heading>

                <flux:button
                    wire:click="readTag"
                    icon="signal"
                    class="py-6 w-full bg-gradient-to-br from-cyan-500 to-teal-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                    :disabled="!$available"
                >
                    Scan NFC Tag
                </flux:button>
            </div>
        </flux:card>

        <!-- Read Results -->
        @if(count($records) > 0)
            <flux:card class="bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700">
                <div class="flex items-center justify-between mb-4">
                    <flux:heading size="md" class="text-green-900 dark:text-green-100">
                        Tag Contents ({{ count($records) }} record{{ count($records) > 1 ? 's' : '' }})
                    </flux:heading>
                    <flux:button size="sm" wire:click="clearResults" icon="x-mark" class="bg-gradient-to-r from-red-500 to-pink-500 !text-white border-0 [&>span]:!text-white">
                        Clear
                    </flux:button>
                </div>

                @if($tagId)
                    <div class="mb-3 text-sm text-muted-foreground">
                        Tag ID: <span class="font-mono font-semibold">{{ $tagId }}</span>
                    </div>
                @endif

                <div class="space-y-2">
                    @foreach($records as $index => $record)
                        <div wire:key="record-{{ $index }}" class="p-4 rounded-lg bg-white/50 dark:bg-gray-800/50 border-2 border-white/50 backdrop-blur-sm">
                            <div class="flex items-center gap-2 mb-1">
                                <flux:badge class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white border-0">{{ strtoupper($record['type'] ?? 'unknown') }}</flux:badge>
                                @if(isset($record['language']))
                                    <span class="text-xs text-muted-foreground font-semibold">{{ $record['language'] }}</span>
                                @endif
                                @if(isset($record['mimeType']))
                                    <span class="text-xs text-muted-foreground font-semibold">{{ $record['mimeType'] }}</span>
                                @endif
                            </div>
                            <div class="font-mono text-sm break-all font-semibold mt-2">{{ $record['value'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
            </flux:card>
        @endif

        <!-- Write Section -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <div class="space-y-4">
                <flux:heading size="md">Write Tag</flux:heading>

                <div class="space-y-2">
                    <flux:label class="text-base font-semibold">Record Type</flux:label>
                    <flux:select wire:model.live="writeType" placeholder="Choose type...">
                        <flux:select.option value="text">Text</flux:select.option>
                        <flux:select.option value="uri">URI / URL</flux:select.option>
                        <flux:select.option value="mime">MIME Data</flux:select.option>
                    </flux:select>
                </div>

                <div class="space-y-2">
                    <flux:label class="text-base font-semibold">Content</flux:label>
                    <flux:input
                        wire:model="writeContent"
                        placeholder="{{ $writeType === 'uri' ? 'https://example.com' : 'Enter text to write...' }}"
                    />
                </div>

                <flux:button
                    wire:click="writeTag"
                    icon="pencil-square"
                    class="py-6 w-full bg-gradient-to-br from-orange-500 to-amber-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                    :disabled="!$available || !$writeContent"
                >
                    Write to NFC Tag
                </flux:button>
            </div>
        </flux:card>

        <!-- Write Success -->
        @if($written)
            <flux:card class="bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700">
                <div class="flex items-center gap-3">
                    <flux:icon icon="check-circle" class="size-8 text-green-600" />
                    <flux:heading size="md" class="text-green-900 dark:text-green-100">
                        Tag written successfully!
                    </flux:heading>
                </div>
            </flux:card>
        @endif

        <!-- Error Display -->
        @if($lastError)
            <flux:card class="bg-gradient-to-br from-red-100 to-pink-100 dark:from-red-900/30 dark:to-pink-900/30 border-2 border-red-200 dark:border-red-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <flux:icon icon="exclamation-circle" class="size-8 text-red-600" />
                        <div>
                            <flux:heading size="md" class="text-red-900 dark:text-red-100">Error</flux:heading>
                            <p class="text-sm text-red-700 dark:text-red-300 mt-1">{{ $lastError }}</p>
                        </div>
                    </div>
                    <flux:button size="sm" wire:click="clearResults" icon="x-mark" class="bg-gradient-to-r from-red-500 to-pink-500 !text-white border-0 [&>span]:!text-white">
                        Dismiss
                    </flux:button>
                </div>
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>
