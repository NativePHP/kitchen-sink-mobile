<div class="space-y-6">
    <x-layouts.app.callout title="Welcome To NativePHP for Mobile!" icon="sparkles">
        The goal for this app is to demo all of the native functionality we have to offer.
        <br/><br/>
        To start, let's begin with authentication and local database storage. Create an account or sign up below.
    </x-layouts.app.callout>

    @if (!session()->has('token'))
        @if ($mode === 'login')
            <livewire:auth.login />
            <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 mt-2">
                {{ __('Don\'t have an account?') }}
                <button
                    wire:click="register"
                    class="ml-1 text-violet-600 hover:underline font-medium">
                    {{ __('Sign up') }}
                </button>
            </div>
        @else
            <livewire:auth.register />
            <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 my-2">
                {{ __('Already have an account?') }}
                <button
                    wire:click="login"
                    class="ml-1 text-violet-600 hover:underline font-medium mb-8">
                    {{ __('Log in') }}
                </button>
            </div>
        @endif
    @else
        <x-layouts.app.callout
            icon="check-circle"
            title="You're in 🎉! Now go and play 🔥" />
    @endif
</div>
