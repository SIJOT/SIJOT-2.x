<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsermanagementTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * @group all
     */
    public function testUsermanagementRoutes()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        // $user = factory(App\User::class)->make(['id' => 5]);
        // factory(App\Permission::class)->make(['user_id' => 5]);
        $this->actingAs($users[0])->visit('/backend/acl');
    }

    /**
     * @group all
     */
    public function testChangeCredentialsFunction()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $data['email'] = $users[0]->email;

        $this->actingAs($users[0])->post('/backend/acl/changeCredentials/'. $users[0]->id, $data)
            ->assertResponseStatus(302);
    }

    /**
     * @group allx
     */
    public function testValidateGreaterThan()
    {
        $rules = [
            'field' => 'required'
        ];

        $data = [
            'field1' => 1,
            'field' => ''
        ];

        $v = $this->app['validator']->make($data, $rules);
        $this->assertTrue($v->passes());
    }
}
