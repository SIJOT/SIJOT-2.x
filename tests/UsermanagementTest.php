<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UsermanagementTest extends TestCase
{
    use WithoutMiddleware, DatabaseMigrations, DatabaseTransactions;

    /**
     * @group all
     * @group backend
     */
    public function testUsermanagementRoutes()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        // $user = factory(App\User::class)->make(['id' => 5]);
        // factory(App\Permission::class)->make(['user_id' => 5]);
        $this->actingAs($users[0])->visit('/backend/acl');
    }

    /**
     * @group all
     * @group backend
     */
    public function testChangeCredentialsFunction()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        // $data['id']    = $users[0]->id;
        $data['email'] = $users[0]->email;
        $data['name'] = $users[0]->name;

        $this->actingAs($users[0])->visit('/backend/acl/profile/'. $users[0]->id)
            ->type($data['name'], 'name')
            ->type($data['email'], 'email')
            ->attach('testingAssets/avatar.jpg', 'avatar')
            ->press('Wijzigen')
            ->seePageIs('/');

        // $this->actingAs($users[0])->post('/backend/acl/changeCredentials/'. $users[0]->id, $data)
        //    ->assertResponseStatus(302);

        // $this->seeInDatabase('users', $data);
    }
}
