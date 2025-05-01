<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupKitchenSinkEnv extends Command
{
    protected $signature = 'kitchensink:setup-env';

    protected $description = 'Copy .env.example and append NativePHP + API env variables';

    public function handle(): int
    {
        $this->info('🔧 Setting up .env file…');

        if (!File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->info('✅ Copied .env.example to .env');
        }

        $envVars = [
            'NATIVEPHP_APP_ID=com.nativephp.kitchensink',
            'NATIVEPHP_APP_VERSION="DEBUG"',
            'NATIVEPHP_APP_VERSION_CODE="1"',
            'NATIVEPHP_GRADLE_PATH="GET FROM ANDROID STUDIO"',
            'NATIVEPHP_ANDROID_SDK_LOCATION="GET FROM ANDROID STUDIO"',
            'KITCHEN_SINK_API_URL="https://kitchen-sink-api-main-a4vrgf.laravel.cloud/api/"',
        ];

        $envContent = File::get(base_path('.env'));
        foreach ($envVars as $line) {
            if (! str_contains($envContent, explode('=', $line)[0])) {
                File::append(base_path('.env'), PHP_EOL . $line);
            }
        }

        $this->info('✅ Environment variables appended successfully.');

        return Command::SUCCESS;
    }
}
