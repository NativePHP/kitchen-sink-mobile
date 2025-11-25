<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-teal-500 to-blue-500 dark:from-teal-600 dark:to-blue-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Network Status
                    </h1>
                    <p class="text-lg text-white">
                        Check your internet connection type and stay informed about your network!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Network Check Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="getNetwork"
                icon="globe-alt"
                class="py-6 w-full bg-gradient-to-br from-teal-500 to-cyan-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Check Network Status
            </flux:button>
        </flux:card>

        <!-- Connection Status Alert -->
        @if($connected)
            <flux:callout icon="sparkles" class="border-purple-400 dark:border-purple-600 bg-gradient-to-br from-purple-100 to-fuchsia-100 dark:from-purple-900/30 dark:to-fuchsia-900/30 border-2 shadow-lg">
                <flux:callout.heading class="text-purple-900 dark:text-purple-100 text-lg font-bold">You are connected!</flux:callout.heading>
                <flux:callout.text class="text-purple-700 dark:text-purple-300 text-base font-semibold">
                    Looks like you are connected via: {{str($status)->upper()}} - You're all set!
                </flux:callout.text>
            </flux:callout>
        @elseif($status)
            <flux:callout icon="exclamation-triangle" class="border-red-400 dark:border-red-600 bg-gradient-to-br from-red-100 to-orange-100 dark:from-red-900/30 dark:to-orange-900/30 border-2 shadow-lg">
                <flux:callout.heading class="text-red-900 dark:text-red-100 text-lg font-bold">Connection Issue</flux:callout.heading>
                <flux:callout.text class="text-red-700 dark:text-red-300 text-base font-semibold">
                    You are {{str($status)->upper()}}
                </flux:callout.text>
            </flux:callout>
        @endif
        <div class="pb-32"></div>
    </div>
</div>
