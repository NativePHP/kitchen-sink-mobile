<div>
    <flux:callout >
        <flux:callout.heading icon="bell">Push Notifications!</flux:callout.heading>

        <flux:callout.text>
            Press the button below to request permission to send push notifications.
        </flux:callout.text>
    </flux:callout>

    <flux:button wire:click="promptForPushNotifications" icon="bell" class="w-full mt-8">Request Push Notifications</flux:button>
    @if ($payload)
        <pre class="text-xs w-full bg-gray-200 dark:bg-gray-800 whitespace-none p-4 rounded-lg shadow-md mt-8 overflow-x-scroll">{{ print_r($payload, true) }}</pre>
    @endif
</div>
