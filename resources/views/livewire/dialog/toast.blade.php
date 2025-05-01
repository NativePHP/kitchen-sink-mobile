<div class="space-y-6">
    <x-layouts.app.callout title="Toast!" icon="bolt">
        Enter some text and press the button below to show a custom toast dialog.
    </x-layouts.app.callout>

    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 space-y-6 mt-8">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Toasty!
            </label>
            <input
                type="text"
                wire:model="message"
                class="w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-800 dark:text-white px-1 py-2"
            />
            @error('toast')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <x-layouts.app.button
            title="Show Toast"
            icon="bolt"
            wire:click="toast"
        />
    </div>
</div>
