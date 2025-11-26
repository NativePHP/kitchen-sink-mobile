<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-fuchsia-500 to-purple-500 dark:from-fuchsia-600 dark:to-purple-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Notifications
                    </h1>
                    <p class="text-lg text-white">
                        Stay connected! Enable push notifications to never miss an update!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Request Notifications Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="promptForPushNotifications"
                icon="bell"
                class="py-6 w-full bg-gradient-to-br from-fuchsia-500 to-purple-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Request Push Notifications
            </flux:button>
        </flux:card>

        @if($token)
            <!-- Send Test Notification Card -->
            <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-fuchsia-200 dark:border-fuchsia-800">
                <flux:button
                    wire:click="sendNotification"
                    icon="paper-airplane"
                    class="py-6 w-full bg-gradient-to-br from-purple-500 to-pink-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                >
                    Send Test Notification
                </flux:button>
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
        <div class="pb-32"></div>
    </div>
</div>
