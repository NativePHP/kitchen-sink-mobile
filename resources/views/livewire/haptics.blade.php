<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-violet-500 to-purple-500 dark:from-violet-600 dark:to-purple-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Haptic Feedback
                    </h1>
                    <p class="text-lg text-white">
                        Feel the buzz! Experience tactile vibration feedback on your device!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Vibration Button Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-violet-200 dark:border-violet-800">
            <flux:button
                wire:click="vibrate"
                icon="device-phone-mobile"
                class="py-6 w-full bg-gradient-to-br from-violet-500 to-purple-500 !text-white border-0 shadow transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Vibrate!
            </flux:button>
        </flux:card>
    </div>
</div>
