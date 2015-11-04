<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class AuthencationTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions, DatabaseMigrations;

    public function testLogout()
    {
        Auth::loginUsingId(1);
        $this->visit('/logout');
    }

    public function testLoginView() {
        $form = $this->visit('/login');
        $form->type('topairy@gmail.com', 'email');
        $form->type('root1995!', 'password');
        $form->press('Log in');

    }
}