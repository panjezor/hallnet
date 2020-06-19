<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeComposer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:composer';

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
        $this->call('composer install --optimize-autoloader --no-dev');
        $this->info('Composer optimized for live.');

    }
}
