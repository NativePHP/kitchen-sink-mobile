<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-emerald-500 to-teal-500 dark:from-emerald-600 dark:to-teal-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Wallet
                    </h1>
                    <p class="text-lg text-white">
                        Accept payments with Apple Pay and Google Pay using Stripe!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Wallet Availability Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <div class="flex items-center justify-between p-4 rounded-lg {{ $walletAvailable ? 'bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700' : 'bg-gradient-to-r from-amber-100 to-yellow-100 dark:from-amber-900/30 dark:to-yellow-900/30 border-2 border-amber-200 dark:border-amber-700' }}">
                <div class="space-y-0.5">
                    <flux:label class="text-base font-semibold">Wallet Status</flux:label>
                    <div class="text-sm text-muted-foreground">
                        {{ $walletAvailable ? 'Apple Pay / Google Pay is available' : 'Native wallet not available on this device' }}
                    </div>
                </div>
                <flux:badge class="{{ $walletAvailable ? 'bg-gradient-to-r from-green-500 to-emerald-500' : 'bg-gradient-to-r from-amber-500 to-yellow-500' }} text-white border-0">
                    {{ $walletAvailable ? 'Ready' : 'Unavailable' }}
                </flux:badge>
            </div>
        </flux:card>

        <!-- Payment Card -->
        @if($status === 'idle' || $status === 'processing')
            <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
                <div class="space-y-4">
                    <div class="space-y-2">
                        <flux:label class="text-base font-semibold">Amount (cents)</flux:label>
                        <flux:input
                            type="number"
                            wire:model="amount"
                            min="50"
                            step="50"
                            placeholder="Enter amount in cents"
                        />
                        <div class="text-sm text-muted-foreground">
                            Total: ${{ number_format($amount / 100, 2) }}
                        </div>
                    </div>

                    <flux:button
                        wire:click="pay"
                        icon="credit-card"
                        class="py-6 w-full bg-gradient-to-br from-emerald-500 to-teal-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                        :disabled="$status === 'processing'"
                    >
                        @if($status === 'processing')
                            <span class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        @else
                            Pay ${{ number_format($amount / 100, 2) }}
                        @endif
                    </flux:button>
                </div>
            </flux:card>
        @endif

        <!-- Success Result -->
        @if($status === 'success')
            <flux:card class="bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700">
                <flux:heading size="md" class="text-green-900 dark:text-green-100 mb-4">
                    Payment Successful!
                </flux:heading>

                <div class="space-y-4">
                    <div>
                        <flux:label class="text-base font-semibold">Payment Intent ID</flux:label>
                        <div class="mt-1 p-4 rounded-lg bg-white/50 dark:bg-gray-800/50 border-2 border-white/50 backdrop-blur-sm">
                            <div class="font-mono text-sm break-all font-semibold">{{ $paymentIntentId }}</div>
                        </div>
                    </div>

                    <flux:button wire:click="resetPayment" icon="arrow-path" class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-500 !text-white border-0 text-xl [&>span]:!text-white">
                        Make Another Payment
                    </flux:button>
                </div>
            </flux:card>
        @endif

        <!-- Failed Result -->
        @if($status === 'failed')
            <flux:card class="bg-gradient-to-br from-red-100 to-pink-100 dark:from-red-900/30 dark:to-pink-900/30 border-2 border-red-200 dark:border-red-700">
                <flux:heading size="md" class="text-red-900 dark:text-red-100 mb-4">
                    Payment Failed
                </flux:heading>

                <div class="space-y-4">
                    @if($errorMessage)
                        <div>
                            <flux:label class="text-base font-semibold">Error</flux:label>
                            <div class="mt-1 p-4 rounded-lg bg-white/50 dark:bg-gray-800/50 border-2 border-white/50 backdrop-blur-sm">
                                <div class="text-sm font-semibold text-red-700 dark:text-red-300">{{ $errorMessage }}</div>
                            </div>
                        </div>
                    @endif

                    <flux:button wire:click="resetPayment" icon="arrow-path" class="w-full py-4 bg-gradient-to-r from-red-500 to-pink-500 !text-white border-0 text-xl [&>span]:!text-white">
                        Try Again
                    </flux:button>
                </div>
            </flux:card>
        @endif

        <!-- Cancelled Result -->
        @if($status === 'cancelled')
            <flux:card class="bg-gradient-to-br from-amber-100 to-yellow-100 dark:from-amber-900/30 dark:to-yellow-900/30 border-2 border-amber-200 dark:border-amber-700">
                <flux:heading size="md" class="text-amber-900 dark:text-amber-100 mb-4">
                    Payment Cancelled
                </flux:heading>

                <div class="space-y-4">
                    <div class="text-sm text-amber-700 dark:text-amber-300">
                        {{ $errorMessage ?? 'The payment was cancelled.' }}
                    </div>

                    <flux:button wire:click="resetPayment" icon="arrow-path" class="w-full py-4 bg-gradient-to-r from-amber-500 to-yellow-500 !text-white border-0 text-xl [&>span]:!text-white">
                        Try Again
                    </flux:button>
                </div>
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>