<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ECommerceInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install & Customize data for ECommerce store';

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
     * @return int
     */
    public function handle()
    {
        if ($this->option('force')) {
            $this->proceed();
        } else {
            if ($this->confirm('Continue? This will reset all your data.')) {
                $this->callSilent('storage:link');
            }
        }
    }
}
