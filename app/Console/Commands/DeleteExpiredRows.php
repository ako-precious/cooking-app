<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class DeleteExpiredRows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:delete-expired-rows';

    protected $signature = 'database:delete-expired-rows';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired rows from the database table';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    DB::table('notification')
        ->where('my_date_column', '<', now()->subDays(30))
        ->delete();

    }
}
