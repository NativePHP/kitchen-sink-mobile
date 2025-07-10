<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.globe-alt variant="mini" class="mr-2"/>
            In App Browser
        </flux:heading>

        <flux:subheading >
            <p>NativePHP allows you to open up a new browser tab that is "owned" by your app. This is essential when working with Oauth redirects since you need to provide a redirect URL that would naturally open in the users default browser. Use in conjunction with App/Universal/Deep links in those scenarios.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="globe-alt" wire:click="openUrl" class="w-full">Open Url</flux:button>
</div>
