<?php

use App\User;
use Illuminate\Database\Seeder;
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
        $user           = new User();
        $user->name     = 'Tim Joosten';
        $user->email    = 'Topairy@gmail.com';
        $user->password = Hash::make('root1995!');
        $user->save();
    }
}
