<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthencationTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * @group backend
     * @group all
     */
    public function testLogout()
    {
        $user = factory(App\User::class)->make();

        $url = $this->actingAs($user)->visit('/logout');
        $url->seePageIs('/');
    }

    /**
     * @group backend
     * @group all
     */
    public function testDeleteUser()
    {
        // User with the right permission
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make());
            })->load('permission');

        $this->actingAs($users[0])->visit('/backend/acl/delete/'. $users[0]->id)->assertResponseStatus(200);

        // User with the wrong permission.
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make([
                        'ledenbeheer' => 0,
                    ]));
            })->load('permission');

        $this->actingAs($user[0])->visit('/backend/acl/delete/'.$user[0]->id)->assertResponseStatus(200);
    }

    /**
     * @group all
     */
    public function testLoginView()
    {
        $this->call('get', '/login');
    }

    /**
     * @group all
     */
    public function testLoginMethod()
    {
        $input = ['email' => 'example@domain.be', 'password' => bcrypt('test')];
        $this->post('/login', $input)->assertResponseStatus(302);
    }
}
