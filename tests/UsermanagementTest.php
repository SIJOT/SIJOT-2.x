<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsermanagementTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * @group all
     */
    public function testUsermanagementRoutes()
    {
        $this->visit('/backend/acl');
    }
}
