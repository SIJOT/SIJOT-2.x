<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsermanagementTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUsermanagementRoutes()
    {
        $this->visit('/backend/acl');
    }
}
