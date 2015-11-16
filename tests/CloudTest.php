<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CloudTest extends TestCase
{

    /**
     * @group all
     */
    public function testCloudRoutes()
    {
        $this->visit('/cloud/index');
        $this->visit('/cloud/download/1');
        $this->visit('/cloud/delete/1');
    }

    /**
     * @group all
     */
    public function testHyperlinks()
    {
        // Navbar

        // Content
    }
}
