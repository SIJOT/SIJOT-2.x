<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class rentalTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions, DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRentalHyperlinksIndexBackend()
    {
        $baseUrl = $this->visit('/backend/rental');

        // Navbar
        if (Auth::check()) {
            $baseUrl->click('Takken')->seePageIs('/backend/takken/update');
            $baseUrl->click('Verhuur')->seePageIs('/backend/rental');
            $baseUrl->click('Cloud')->seePageIs('/cloud/index');
        }

        $baseUrl->click('Sint-Joris')->seePageIs('/');
        //$baseUrl->click()->seePageIs();
       // $baseUrl->click()->seePageIs();

        // Content
        //$baseUrl->click('')->seePageis('');
    }
}
