<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class databaseTest extends TestCase
{
    /**
     * @group database
     */
    public function testPermissionsRelation()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make());
            });

        $ArrayUserData = $users->load('permission')[0];
        $ArrayUserPerm = $users->load('permission')[0]['permission'];

        // dd($ArrayUserData);
        // dd($ArrayUserPerm);

        // User data assertions.
        $this->assertArrayHasKey('id', $ArrayUserData);
        $this->assertArrayHasKey('name', $ArrayUserData);
        $this->assertArrayHasKey('email', $ArrayUserData);
        $this->assertArrayHasKey('password', $ArrayUserData);
        $this->assertArrayHasKey('role', $ArrayUserData);
        $this->assertArrayHasKey('blocked', $ArrayUserData);
        $this->assertArrayHasKey('remember_token', $ArrayUserData);
        $this->assertArrayHasKey('created_at', $ArrayUserData);
        $this->assertArrayHasKey('updated_at', $ArrayUserData);

        // User permissions assertions.
    }
    
    /**
     * @group database
     */
    public function testNotificationsRelation()
    {
         $users = factory(App\User::class, 3)
            ->create()
            ->each(function($user) {
                $user->notification()
                    ->save(factory(App\Notifications::class)->make());
            });

        $ArrayUserData = $users->load('notification')[0];
        $ArrayUserNoti = $users->load('notification')[0]['notification'];
        
        // User data assertions.
        $this->assertArrayHasKey('id', $ArrayUserData);
        $this->assertArrayHasKey('name', $ArrayUserData);
        $this->assertArrayHasKey('email', $ArrayUserData);
        $this->assertArrayHasKey('password', $ArrayUserData);
        $this->assertArrayHasKey('role', $ArrayUserData);
        $this->assertArrayHasKey('blocked', $ArrayUserData);
        $this->assertArrayHasKey('remember_token', $ArrayUserData);
        $this->assertArrayHasKey('created_at', $ArrayUserData);
        $this->assertArrayHasKey('updated_at', $ArrayUserData);
        
        // Notification assertions.
    }
}
