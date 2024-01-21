<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupDev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('app:clean-up');
        $this->call('migrate:fresh');
        $this->call('db:seed');
    }
}
