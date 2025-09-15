<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <x-heroicon-m-sparkles class="size-5 mr-2" />
            Welcome to NativePHP for Mobile!!
        </flux:heading>

        <flux:subheading >
            <p>The goal for this app is to demo all of the native functionality we have to offer.</p>
            <br/>
            <p>To start, let's begin with authentication and local database storage. Create an account or sign up below.</p>
        </flux:subheading>
    </flux:card>

    @if (!$this->alreadySecure)
        @if ($mode === 'login')
            <livewire:auth.login/>
            <flux:button variant="ghost" class="w-full" wire:click="register">Sign up for a new account</flux:button>
        @else
            <livewire:auth.register/>
            <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 my-2">
                {{ __('Already have an account?') }}
                <flux:button
                    variant="ghost"
                    wire:click="login">
                    {{ __('Log in') }}
                </flux:button>
            </div>
        @endif
    @else
{{--        <flux:card>--}}
{{--            <flux:heading size="lg" class="flex space-x-2">--}}

{{--                You're in 🎉<br/> Now go and play 🔥--}}
{{--            </flux:heading>--}}
{{--        </flux:card>--}}
    @endif
</div>
