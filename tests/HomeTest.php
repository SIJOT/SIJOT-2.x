<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions, DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexUrl()
    {
        $this->visit('/');

        // check hyperlinks navbar

        // Check hyperlinks Content
    }
}
