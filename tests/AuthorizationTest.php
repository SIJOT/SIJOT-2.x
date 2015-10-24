<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class AuthorizationTest extends TestCase
{
    public function testLoginView()
    {
        $this->get('/login');
    }

    public function testLoginMethod()
    {
        $this->post('/login');
    }

    public function testLogoutUrl()
    {
        $this->get('/logout');
    }

    public function testUserBlock()
    {

    }

    public function testUserUnlock()
    {
    }
}
