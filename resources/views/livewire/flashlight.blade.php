<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-yellow-400 to-amber-500 dark:from-yellow-500 dark:to-amber-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Flashlight
                    </h1>
                    <p class="text-lg text-white">
                        Illuminate the darkness! Control your device's flashlight with a tap!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Flashlight Button Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-yellow-200 dark:border-yellow-800">
            <flux:button
                wire:click="flashlight"
                icon="light-bulb"
                class="py-6 w-full bg-gradient-to-br from-yellow-400 to-amber-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Toggle Flashlight
            </flux:button>
        </flux:card>

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
        <div class="pb-32"></div>
    </div>
</div>
