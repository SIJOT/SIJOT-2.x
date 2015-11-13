<?php

use Illuminate\Database\Seeder;

class NotificationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Notifications::truncate();

        $permission = new App\Notifications();
        $permission->user_id   = 1;
        $permission->verhuring = 1;
        $permission->save();
    }
}
