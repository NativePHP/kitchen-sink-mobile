<x-layouts.app.card class="mt-10">
    <div class="flex flex-col gap-6">
        <!-- Session Status -->

        <form wire:submit.prevent="login" class="flex flex-col gap-6">
            <!-- Email Address -->
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">
                    Email address
                </label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="block w-full rounded-md border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-violet-500 focus:ring focus:ring-violet-500/50"
                />
                @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Password -->
            <div class="relative">
                <div class="space-y-1">
                    <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        wire:model="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="block w-full rounded-md border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-violet-500 focus:ring focus:ring-violet-500/50"
                    />
                    @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="absolute right-0 top-0 text-sm text-violet-600 hover:underline">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div>
                <x-layouts.app.button type="submit" title="Log in" icon="lock-closed" />
            </div>
        </form>
    </div>
</x-layouts.app.card>
