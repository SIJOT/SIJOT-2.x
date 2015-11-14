<?php

use App\Verhuring;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class rentalTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRentalHyperlinksIndexBackend()
    {
        $user = factory(App\User::class)->make();
        $perm = factory(App\Permission::class)->make([
            'user_id' => $user->id
        ]);

        $baseUrl = $this->actingAs($user)
            ->withSession((array) $perm)
            ->visit('/backend/rental');


        // Navbar
        if (Auth::check()) {
            // $baseUrl->click('Takken')->seePageIs('/backend/takken/update');
            // $baseUrl->click('Verhuur')->seePageIs('/backend/rental');
            $baseUrl->click('Cloud')->seePageIs('/cloud/index');
        }

        // $baseUrl->click('Sint-Joris')->seePageIs('/');
        // $baseUrl->click()->seePageIs();
        // $baseUrl->click()->seePageIs();

        // Content
        //$baseUrl->click('')->seePageis('');
    }

    public function testRentalFrontEndHyperlink()
    {
        $this->visit('/verhuur')
            ->see('Verhuur')
            ->see('Bereikbaarheid');
    }

    public function testRentalFrontEndHyperlinkBereikbaarheid()
    {
        $this->visit('/verhuur/bereikbaarheid');
    }

    public function testRentalFrontEndHyperlinkKalender()
    {
        $this->visit('/verhuur/kalender');
    }

    public function testRentalFrontEndHyperlinkAanvraag()
    {

    }
}
