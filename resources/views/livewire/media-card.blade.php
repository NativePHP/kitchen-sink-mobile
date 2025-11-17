<flux:card>
    <div class="space-y-3">
        <div class="min-w-0">

            <div class="font-medium text-lg truncate">
                {{ $media['name'] }}
            </div>
            <div class="flex space-x-2">
                <div class="text-lg text-zinc-500 dark:text-zinc-400">
                    {{ \Carbon\Carbon::createFromTimestamp($media['date'])->format('M j, Y') }}
                </div>
                <div class="text-lg text-zinc-500 dark:text-zinc-400">
                    {{ \Carbon\Carbon::createFromTimestamp($media['date'])->format('g:i A') }}
                </div>
                <div class="text-lg text-zinc-500 dark:text-zinc-400">
                    {{ number_format($media['size'] / 1024 / 1024, 2) }} MB
                </div>
            </div>
        </div>

        @if($showButtons)

            <div class="grid grid-cols-3 gap-2">
                <button wire:click="play"
                        class="bg-zinc-500 text-white flex items-center justify-center w-full p-4 py-2 rounded-lg">
                    <flux:icon.play class="size-6"></flux:icon.play>
                </button>
                <button wire:click="share"
                        class="bg-zinc-500 text-white flex items-center justify-center w-full p-4 py-2 rounded-lg">
                    <flux:icon.share class="size-6"></flux:icon.share>
                </button>
                <button wire:click="delete"
                        class="bg-zinc-500 text-white flex items-center justify-center w-full p-4 py-2 rounded-lg">
                    <flux:icon.trash class="size-6"></flux:icon.trash>
                </button>
            </div>
        @endif
    </div>
</flux:card>
