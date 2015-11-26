<?php


class databaseTest extends TestCase
{
    /**
     * @group all
     * @group database
     */
    public function testPermissionsRelation()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
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
        $this->assertArrayHasKey('user_id', $ArrayUserPerm);
        $this->assertArrayHasKey('cloud', $ArrayUserPerm);
        $this->assertArrayHasKey('verhuurbeheer', $ArrayUserPerm);
        $this->assertArrayHasKey('ledenbeheer', $ArrayUserPerm);
        $this->assertArrayHasKey('media', $ArrayUserPerm);
        $this->assertArrayHasKey('created_at', $ArrayUserData);
        $this->assertArrayHasKey('updated_at', $ArrayUserData);
    }

    /**
     * @group all
     * @group database
     */
    public function testNotificationsRelation()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
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
        $this->assertArrayHasKey('created_at', $ArrayUserNoti);
        $this->assertArrayHasKey('updated_at', $ArrayUserNoti);
        $this->assertArrayHasKey('verhuring', $ArrayUserNoti);
        $this->assertArrayHasKey('user_id', $ArrayUserNoti);
        $this->assertArrayHasKey('id', $ArrayUserNoti);
    }
}
