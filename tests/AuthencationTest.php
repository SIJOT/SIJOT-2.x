<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthencationTest extends TestCase
{
    use WithoutMiddleware;

    public function testLoginPost()
    {
        $this->post('/auth/login', ['email' => 'username']);
    }
}