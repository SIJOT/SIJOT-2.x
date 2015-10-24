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
    public function testConsoleIndexPage()
    {
        $url = $this->call('GET', '/backend/acl');
        $this->assertEquals(200, $url->getStatusCode());
    }
}
