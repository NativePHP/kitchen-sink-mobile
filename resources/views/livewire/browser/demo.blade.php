<div class="space-y-6">
    <!-- Header Card -->
    <flux:card>
        <flux:heading size="lg" class="flex items-center">
            <flux:icon.globe-alt variant="mini" class="mr-2"/>
            Browser API Demo
        </flux:heading>
        <flux:subheading>
            <p>NativePHP provides three browser methods to handle different use cases for opening URLs in mobile apps.</p>
        </flux:subheading>
    </flux:card>

    <!-- In-App Browser Section -->
    <flux:card>
        <flux:heading size="base" class="flex items-center mb-2">
            <flux:icon.window variant="mini" class="mr-2"/>
            In-App Browser
        </flux:heading>
        <flux:text class="mb-4">
            Opens URLs in an embedded browser within your app. Uses Custom Tabs on Android and SFSafariViewController on iOS. Perfect for keeping users within your app experience while browsing external content.
        </flux:text>
        <flux:button variant="outline" icon="globe-alt" wire:click="openInApp" class="w-full">
            Open in In-App Browser
        </flux:button>
    </flux:card>

    <!-- System Browser Section -->
    <flux:card>
        <flux:heading size="base" class="flex items-center mb-2">
            <flux:icon.arrow-top-right-on-square variant="mini" class="mr-2"/>
            System Browser
        </flux:heading>
        <flux:text class="mb-4">
            Opens URLs in the device's default browser app. This completely leaves your app and switches to the external browser. Useful when you want users to have the full browser experience or when the content requires it.
        </flux:text>
        <flux:button variant="outline" icon="arrow-top-right-on-square" wire:click="openSystem" class="w-full">
            Open in System Browser
        </flux:button>
    </flux:card>

    <!-- Auth Browser Section -->
    <flux:card>
        <flux:heading size="base" class="flex items-center mb-2">
            <flux:icon.shield-check variant="mini" class="mr-2"/>
            Authentication Browser
        </flux:heading>
        <flux:text class="mb-4">
            Specialized browser for OAuth authentication flows. Automatically handles redirect URLs with the nativephp:// scheme. Perfect for integrating with services like WorkOS, Auth0, or any OAuth provider. The browser session is isolated for security.
        </flux:text>
        <flux:separator class="my-4"/>
        <flux:text class="text-sm">
            <strong>To see this in action:</strong>
            <ol class="list-decimal list-inside mt-2 space-y-1">
                <li>Logout from the app </li>
                <li>Click "Log in/Sign up with WorkOS" on the login screen</li>
                <li>The auth browser will open for the OAuth flow</li>
                <li>After authentication, you'll be redirected back to the app</li>
            </ol>
        </flux:text>
    </flux:card>
</div>
