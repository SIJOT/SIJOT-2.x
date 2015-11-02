<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CloudTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCloudIndex()
    {
        $this->visit('/cloud/index');
    }

    public function testCloudDelete() {
        $this->visit('/cloud/delete/1');
    }
}
