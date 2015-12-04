<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class rentalTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * @group all
     * @group rental
     */
    public function testRentalHyperlinksIndexBackend()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make([
                    'verhuurbeheer' => 1
                ]));
            })->load('permission');

        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make([
                    'verhuurbeheer' => 0
                ]));
            })->load('permission');

        // Wrong permissions.
        $this->actingAs($users[0])->visit('/backend/rental')->assertResponseStatus(200);

        // Correct permissions.
        $this->actingAs($user[0])->visit('/backend/rental')->assertResponseStatus(200);

        // Navbar
        if (Auth::check()) {
            // $baseUrl->click('Takken')->seePageIs('/backend/takken/update');
            // $baseUrl->click('Verhuur')->seePageIs('/backend/rental');
            // $baseUrl->click('Cloud')->seePageIs('/cloud/index');
        }

        // $baseUrl->click('Sint-Joris')->seePageIs('/');
        // $baseUrl->click()->seePageIs();
        // $baseUrl->click()->seePageIs();

        // Content
        //$baseUrl->click('')->seePageis('');
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalFrontEndHyperlink()
    {
        $this->visit('/verhuur')
            ->see('Verhuur')
            ->see('Bereikbaarheid');
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalFrontEndHyperlinkBereikbaarheid()
    {
        $this->visit('/verhuur/bereikbaarheid');
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalFrontEndHyperlinkKalender()
    {
        $this->visit('/verhuur/kalender');
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalFrontEndHyperlinkAanvraag()
    {
        $rental = factory(App\Verhuring::class)->make();

        // Test the form.
        $this->visit('/verhuur/aanvragen')
            ->type($rental->Start_Datum, 'StartDatum')
            ->type($rental->Eind_datum, 'EindDatum')
            ->type($rental->Groep, 'Groep')
            ->type($rental->Email, 'Email')
            ->press('Aanvragen')
            ->seePageIs('verhuur/aanvragen');
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalsetToOption()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $verhuring = factory(App\Verhuring::class)->make([
            'id' => 5,
        ]);

        $this->actingAs($user[0])->visit('/backend/rental/option/'.$verhuring->id)
            ->assertResponseStatus(200);
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalSetToConfirmed()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make([
                    'verhuurbeheer' => 0,
                ]));
            })->load('permission');

        $verhuring = factory(App\Verhuring::class)->make([
            'id' => 5,
        ]);

        // Wrong permissions
        $this->actingAs($users[0])->visit('/backend/rental/confirm/'.$verhuring->id);

        // Correct permissions
        $this->actingAs($user[0])->visit('/backend/rental/confirm/'.$verhuring->id);
    }

    /**
     * @group all
     * @group rental
     */
    public function testPostRentalInsertmethod()
    {
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalDelete()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $this->actingAs($user[0])->visit('/backend/rental/delete/'.$user[0]->id);
    }
}
