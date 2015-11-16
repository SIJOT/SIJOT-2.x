<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{


    /**
     * @group all
     */
    public function testIndexUrl()
    {
        $this->visit('/');

        // check hyperlinks navbar

        // Check hyperlinks Content
    }
}
