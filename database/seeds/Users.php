<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate method.
        DB::statement('SET foreign_key_checks=0');
        User::truncate();
        DB::statement('SET foreign_key_checks=1');

        // Input method.
        $user = new User();
        $user->name = 'Tim Joosten';
        $user->email = 'Topairy@gmail.com';
        $user->password = Hash::make('root1995!');
        $user->role = 1;
        $user->blocked = 0;
        $user->save();
    }
}
