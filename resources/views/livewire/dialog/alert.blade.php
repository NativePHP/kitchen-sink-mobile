<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-rose-500 to-pink-500 dark:from-rose-600 dark:to-pink-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Alert Dialog
                    </h1>
                    <p class="text-lg text-white">
                        Native alert dialogs with custom buttons and callbacks!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="alert"
                icon="bell-alert"
                class="py-6 w-full bg-gradient-to-br from-rose-500 to-pink-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Show Alert
            </flux:button>
        </flux:card>
        <div class="pb-32"></div>
    </div>
</div>
