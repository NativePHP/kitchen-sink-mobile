<div class="mt-10 bg-white dark:bg-zinc-900 rounded-lg shadow p-6 space-y-6">
    <!-- Session Status -->
    @if (session('status'))
        <div class="text-center text-sm text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="register" class="space-y-6">
        <!-- Name -->
        <div class="space-y-1">
            <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">
                Name
            </label>
            <input
                id="name"
                type="text"
                wire:model.defer="name"
                required
                autocomplete="name"
                placeholder="Full name"
                class="block w-full rounded-md border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-violet-500 focus:ring focus:ring-violet-500/50"
            />
            @error('name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div class="space-y-1">
            <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">
                Email address
            </label>
            <input
                id="email"
                type="email"
                wire:model.defer="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
                class="block w-full rounded-md border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-violet-500 focus:ring focus:ring-violet-500/50"
            />
            @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">
                Password
            </label>
            <input
                id="password"
                type="password"
                wire:model.defer="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
                class="block w-full rounded-md border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-violet-500 focus:ring focus:ring-violet-500/50"
            />
            @error('password') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-200">
                Confirm password
            </label>
            <input
                id="password_confirmation"
                type="password"
                wire:model.defer="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••"
                class="block w-full rounded-md border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 px-3 py-2 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-violet-500 focus:ring focus:ring-violet-500/50"
            />
            @error('password_confirmation') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <div>
            <flux:button class="w-full" type="submit">{{ __('Create account') }} </flux:button>
        </div>
    </form>
</div>
