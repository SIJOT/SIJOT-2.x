<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class AuthencationTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions, DatabaseMigrations;

    public function testLogout()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(1);

        $url = $this->visit('/logout');
        $url->seePageIs('/');
    }

    public function testLoginView()
    {
        $this->call('get', '/login');
    }
}