<?php

use App\Verhuring;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class rentalTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * @group all
     */
    public function testRentalHyperlinksIndexBackend()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $baseUrl = $this->actingAs($user[0])->visit('/backend/rental');

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

    /**
     * @group all
     */
    public function testRentalFrontEndHyperlink()
    {
        $this->visit('/verhuur')
            ->see('Verhuur')
            ->see('Bereikbaarheid');
    }

    /**
     * @group all
     */
    public function testRentalFrontEndHyperlinkBereikbaarheid()
    {
        $this->visit('/verhuur/bereikbaarheid');
    }

    /**
     * @group all
     */
    public function testRentalFrontEndHyperlinkKalender()
    {
        $this->visit('/verhuur/kalender');
    }

    /**
     * @group all
     */
    public function testRentalFrontEndHyperlinkAanvraag()
    {
        $rental = factory(App\Verhuring::class)->make();

        // Test the form.
        $this->visit('/verhuur/aanvragen')
            ->type($rental->Start_Datum,'StartDatum')
            ->type($rental->Eind_datum, 'EindDatum')
            ->type($rental->Groep,'Groep')
            ->type($rental->Email,'Email')
            ->press('Aanvragen')
            ->seePageIs('verhuur/aanvragen');
    }

    /**
     * @group all
     */
    public function testRentalsetToOption()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $verhuring = factory(App\Verhuring::class)->make([
            'id' => 5
        ]);

        $this->actingAs($user[0])->visit('/backend/rental/option/'. $verhuring->id)
            ->assertResponseStatus(200);
    }

    /**
     * @group all
     */
    public function testRentalSetToConfirmed()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $users = factory(App\User::class, 3)
            ->create()
            ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make([
                    'verhuurbeheer' => 0
                ]));
            })->load('permission');

        $verhuring = factory(App\Verhuring::class)->make([
            'id' => 5
        ]);

        // Wrong permissions
        $this->actingAs($users[0])->visit('/backend/rental/confirm/'. $verhuring->id);

        // Correct permissions
        $this->actingAs($user[0])->visit('/backend/rental/confirm/'. $verhuring->id);
    }

    /**
     * @group all
     */
    public function testPostRentalInsertmethod()
    {
    }

    /**
     * @group all
     */
    public function testRentalDelete()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');


        $this->actingAs($user[0])->visit('/backend/rental/delete/'. $user[0]->id);
    }
}
