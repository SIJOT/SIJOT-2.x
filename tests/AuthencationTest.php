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
