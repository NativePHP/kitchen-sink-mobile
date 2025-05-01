<div class="space-y-6">
    <x-layouts.app.callout title="Push Notifications!" icon="bell">
        Press the button below to request permission to send push notifications.
    </x-layouts.app.callout>

    <x-layouts.app.button
        title="Request Push Notifications"
        icon="bell"
        wire:click="promptForPushNotifications"
    />
</div>
