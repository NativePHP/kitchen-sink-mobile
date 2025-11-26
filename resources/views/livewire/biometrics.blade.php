<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-teal-500 to-cyan-500 dark:from-teal-600 dark:to-cyan-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Biometrics
                    </h1>
                    <p class="text-lg text-white">
                        Unlock secure access with your fingerprint or face recognition!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Scanner Button Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="promptForBiometricID"
                icon="finger-print"
                class="py-6 w-full bg-gradient-to-br from-teal-500 to-cyan-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Request Biometric Access
            </flux:button>
        </flux:card>

        <div class="w-full">
            <!-- Success State -->
            @if ($secure)
                <flux:callout icon="check-circle" class="border-green-400 dark:border-green-600 bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 shadow-lg">
                    <flux:callout.heading class="text-green-800 dark:text-green-100">Your account is verified!</flux:callout.heading>
                    <flux:callout.text class="text-green-800 dark:text-green-100 text-base font-semibold">
                        Your account is verified and ready to use!
                    </flux:callout.text>
                </flux:callout>
            @else
                <!-- Warning State -->
                <flux:callout icon="exclamation-triangle" class="border-yellow-400 dark:border-yellow-600 bg-gradient-to-br from-yellow-100 to-orange-100 dark:from-yellow-900/30 dark:to-orange-900/30 border-2 shadow-lg border-l-4">
                    <flux:callout.heading class="text-yellow-800 dark:text-yellow-100">Secure Area</flux:callout.heading>
                    <flux:callout.text class="text-yellow-800 dark:text-yellow-100 text-base font-semibold">
                        This is a SECURE AREA - please authenticate yourself to continue!
                    </flux:callout.text>
                </flux:callout>
            @endif

        </div>
        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>
