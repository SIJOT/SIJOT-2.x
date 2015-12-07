<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:utility
                            {optimize : Optimize the database.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database utilities.';

    /**
     * Create a new command instance.
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
        //
    }
}
