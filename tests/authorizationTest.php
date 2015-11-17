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
        
        $users = factory(App\User::class, 3)
           ->create()
           ->each(function($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');
            
        // $user = factory(App\User::class)->make(['id' => 5]);
        // factory(App\Permission::class)->make(['user_id' => 5]);
        $this->actingAs($users[0])->visit('/backend/acl/profile/' . $users[0]->id);
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
