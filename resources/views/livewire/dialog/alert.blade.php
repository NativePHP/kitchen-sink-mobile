<div class="space-y-6">
    <x-layouts.app.callout title="Alert!" icon="bell-alert">
        Press the button below to show an alert dialog.
    </x-layouts.app.callout>

    <x-layouts.app.button
        title="Show Alert"
        icon="bell-alert"
        wire:click="alert"
    />
</div>
