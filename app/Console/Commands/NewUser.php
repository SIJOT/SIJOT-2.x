<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new user';

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
        $choice = ['false', 'true'];

        // questions
        $name = $this->ask('What is the name of the user');

        // choices
        $verhuurPermission = $this->choice('Assign permission for the rental system.', $choice, false);
        $loginPermission = $this->choice('Assign permission for the user-management system.', $choice, false);

        $this->info('The user is now registered in the system');
    }
}
