<?php

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
           ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        // $user = factory(App\User::class)->make(['id' => 5]);
        // factory(App\Permission::class)->make(['user_id' => 5]);
        $this->actingAs($users[0])->visit('/backend/acl/profile/'.$users[0]->id)
            ->see($users[0]->name)
            ->see($users[0]->id)
            ->see($users[0]->email)
            ->see($users[0]->avatar);
    }

    /**
     * @group all
     */
    public function testBlockuserMethod()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');

        $this->actingAs($user[0])->visit('/backend/acl/block/'.$user[0]->id);
    }

    /**
     * @group all
     */
    public function testUnblockUserMethod()
    {
        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->permission()->save(factory(App\Permission::class)->make());
            })->load('permission');


        $this->actingAs($user[0])->visit('/backend/acl/unblock/'. $user[0]->id);
    }
}
