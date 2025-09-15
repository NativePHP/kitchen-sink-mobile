/** @type {import('tailwindcss').Config} */
import colors from 'tailwindcss/colors';

export default {
    darkMode: 'selector',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './vendor/livewire/**/*.blade.php',
        "./vendor/livewire/flux-pro/stubs/**/*.blade.php",
        "./vendor/livewire/flux/stubs/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                zinc: colors.slate,
            },
        }
    },
    plugins: [],
}

