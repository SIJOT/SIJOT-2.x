<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class rentalTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRentalIndexBackend()
    {
        $this->visit('/backend/rental');
    }
}
