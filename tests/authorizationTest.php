<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class authorizationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProfilePage()
    {
        $user = factory(App\User::class)->make();
        $this->actingAs($user)->visit('/backend/acl/profile/1');
    }
}
