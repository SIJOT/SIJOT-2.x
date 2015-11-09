<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Users::class);
        $this->call(TakkenSeed::class);
        $this->call(user_group_seeder::class);
        $this->call(PermissionTable::class);
        $this->call(NotificationSeed::class);
    }
}