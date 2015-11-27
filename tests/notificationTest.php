<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class notificationTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations, WithoutMiddleware;

    /**
     * @group all
     * @group rental
     */
    public function testVerhuurNotificationOut()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make([
                        'verhuurbeheer' => 1,
                    ]));
            });

        $verhuur = factory(App\Verhuring::class)->make([
            'id' => 1
        ]);

        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make([
                        'verhuurbeheer' => 0,
                    ]));
            });

        // Wrong permission.
        $this->actingAs($user[0])->visit('/notification/uit/' . $verhuur->id);

        // Correct permission.
        $this->actingAs($users[0])->visit('/notification/uit/'.$verhuur->id);
    }

    /**
     * @group all
     * @group rental
     */
    public function testVerhuurNotificationAan()
    {
        $users = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make([
                        'verhuurbeheer' => 1,
                    ]));
            });

        $verhuur = factory(App\Verhuring::class)->make([
            'id' => 1
        ]);

        $user = factory(App\User::class, 3)
            ->create()
            ->each(function ($user) {
                $user->permission()
                    ->save(factory(App\Permission::class)->make([
                        'verhuurbeheer' => 0,
                    ]));
            });

        // Wrong permission.
        $this->actingAs($user[0])->visit('/notification/aan/' . $verhuur->id);

        // Correct permission.
        $this->actingAs($users[0])->visit('/notification/aan/'.$verhuur->id);
    }
}
