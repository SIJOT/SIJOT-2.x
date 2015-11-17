<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class authorizationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @group all
     */
    public function testProfilePage()
    {
        $user = factory(App\User::class)->make(['id' => 5]);
        factory(App\Permission::class)->make(['user_id' => 5]);
        $this->actingAs($user)->visit('/backend/acl/profile/' . $user->id);
    }

    /**
     * @group all
     */
    public function testBlockuserMethod()
    {
        $user = factory(App\User::class)->make([
            'id' => 5
        ]);

        $this->actingAs($user)->visit('/backend/acl/block/'. $user->id);
    }

    /**
     * @group all
     */
    public function testUnblockUserMethod()
    {
        $user = factory(App\User::class)->make([
            'id' => 5
        ]);
    }
}
