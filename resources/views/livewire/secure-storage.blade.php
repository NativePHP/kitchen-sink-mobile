<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-amber-500 to-orange-500 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Secure Storage
                    </h1>
                    <p class="text-lg text-white">
                        Encrypted, military-grade storage for your sensitive data on device!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Store Secure Value Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-amber-200 dark:border-amber-800">
            <flux:heading icon="lock-closed" class="text-amber-900 dark:text-amber-100 mb-4">Store Secure Value</flux:heading>

            <div class="space-y-4">
                <flux:input
                    wire:model="key"
                    label="Key"
                    placeholder="Enter a key name"
                />

                <flux:input
                    wire:model="value"
                    label="Value"
                    placeholder="Enter the value to store securely"
                />

                <flux:button
                    wire:click="setSecureValue"
                    icon="shield-check"
                    class="py-6 w-full bg-gradient-to-br from-amber-500 to-orange-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                >
                    Store Secure Value
                </flux:button>
            </div>
        </flux:card>

        <!-- Retrieve Secure Value Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-green-200 dark:border-green-800">
            <flux:heading icon="key" class="text-green-900 dark:text-green-100 mb-4">Retrieve Secure Value</flux:heading>

            <div class="space-y-4">
                <flux:input
                    wire:model="retrieveKey"
                    label="Key"
                    placeholder="Enter the key to retrieve"

                />

                <flux:button
                    wire:click="getSecureValue"
                    icon="lock-open"
                    class="py-6 w-full bg-gradient-to-br from-green-500 to-emerald-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                >
                    Retrieve Secure Value
                </flux:button>
            </div>
        </flux:card>

        <!-- Delete Secure Value Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-red-200 dark:border-red-800">
            <flux:heading icon="trash" class="text-red-900 dark:text-red-100 mb-4">Delete Secure Value</flux:heading>

            <div class="space-y-4">
                <flux:input
                    wire:model="deleteKey"
                    label="Key"
                    placeholder="Enter the key to delete"

                />

                <flux:button
                    wire:click="deleteSecureValue"
                    icon="x-circle"
                    class="py-6 w-full bg-gradient-to-br from-red-500 to-pink-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                >
                    Delete Secure Value
                </flux:button>
            </div>
        </flux:card>

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
        <div class="pb-32"></div>
    </div>
</div>
