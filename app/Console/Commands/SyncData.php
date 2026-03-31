<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use NativePHP\LocalNotifications\Facades\LocalNotifications;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a log entry in the background';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        LocalNotifications::send('demo-simple')
            ->title('Hello!')
            ->body(now()->toDateTimeString());

        logger('hi mom '.now()->toDateTimeString());

        error_log('[SyncData] storage_path = ' . storage_path('app/sync_data.log'));

        return self::SUCCESS;
    }
}
