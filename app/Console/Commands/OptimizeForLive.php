<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;

class OptimizeForLive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:live';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimizes composer imports';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('optimize:composer');
        Artisan::call('optimize:cache');
        $this->info('Backend optimized and cached.');

    }
}
