<div class="space-y-6 bg-white min-h-screen pt-[var(--inset-top)]">
    <div class="px-4 pt-4">
        <h1 class="text-2xl font-black text-black">Sleep Demo</h1>
        <p class="text-base text-zinc-600 mt-1">
            Test synchronous sleep vs queued sleep to see the difference in UI blocking behavior.
        </p>
    </div>

    <div class="px-4 space-y-4">
        <flux:card>
            <div class="space-y-3">
                <h2 class="font-bold text-lg text-black">Synchronous Sleep</h2>
                <p class="text-sm text-zinc-600">
                    Blocks the UI for 5 seconds while sleeping on the main thread.
                </p>
                <flux:button wire:click="justSleep" icon="clock">
                    Just Sleep
                </flux:button>
            </div>
        </flux:card>

        <flux:card>
            <div class="space-y-3">
                <h2 class="font-bold text-lg text-black">Queued Sleep</h2>
                <p class="text-sm text-zinc-600">
                    Dispatches the sleep to a queue job so the UI remains responsive.
                </p>
                <flux:button wire:click="queueSleep" icon="queue-list">
                    Queue Sleep
                </flux:button>
            </div>
        </flux:card>
    </div>

    <div class="px-4">
        <x-quote lightmode :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>
