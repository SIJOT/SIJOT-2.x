<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class authorizationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProfilePage()
    {
        $this->visit('/backend/acl/profile/1');
    }
}
