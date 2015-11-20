<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class AuthencationTest extends TestCase
{

    /**
     * @group all
     */
    public function testLogout()
    {
        $user = factory(App\User::class)->make();

        $url = $this->actingAs($user)->visit('/logout');
        $url->seePageIs('/');
    }

    /**
     * @group all
     */
    public function testDeleteUser()
    {
        // User with the right permission
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make());
            });

        $this->actingAs($users[0])->visit('/backend/acl/delete/'. $users[0]->id);

        // User with the wrong permission.
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make([
                        'ledenbeheer' => 0
                    ]));
            });

        $this->actingAs($user[0])
            ->visit('/backend/acl/delete/'. $user[0]->id)
            ->assertResponseOk();
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
        $this->post('/login', [
            'email' => 'example@domain.be',
            'password' => bcrypt('test')
        ]);
    }
}
