<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class rentalTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRentalHyperlinksIndexBackend()
    {
        Auth::loginUsingId(1);

        $baseUrl = $this->visit('/backend/rental');

        // Navbar
        $baseUrl->click('Sint-Joris')->seePageIs('/');
        $baseUrl->click('Takken')->seePageIs('/backend/takken/update');
        $baseUrl->click('Verhuur')->seePageIs('/backend/rental');
        $baseUrl->click('Cloud')->seePageIs('/cloud/index');

        // Content
        //$baseUrl->click('')->seePageis('');
    }
}
