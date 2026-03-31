<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-emerald-500 to-teal-500 dark:from-emerald-600 dark:to-teal-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Data Messages
                    </h1>
                    <p class="text-lg text-white">
                        FCM data messages processed via ephemeral PHP threads.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="space-y-4 px-4" wire:poll.1s>
        <!-- Messages List -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <div class="flex items-center justify-between mb-4">
                <flux:heading size="lg">Received Messages</flux:heading>
                @if($this->messages->count())
                    <flux:button wire:click="clear" size="sm" variant="danger">
                        Clear All
                    </flux:button>
                @endif
            </div>

            @forelse($this->messages as $message)
                <div class="py-3 {{ !$loop->last ? 'border-b border-zinc-200 dark:border-zinc-700' : '' }}">
                    <p class="text-sm text-zinc-800 dark:text-zinc-200">{{ $message->text }}</p>
                    <p class="text-xs text-zinc-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-zinc-400 dark:text-zinc-500 text-center py-8">
                    No messages yet. Send a data message via FCM to see it appear here.
                </p>
            @endforelse
        </flux:card>

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
        <div class="pb-32"></div>
    </div>
</div>
