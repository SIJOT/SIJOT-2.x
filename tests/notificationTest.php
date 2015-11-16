<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class notificationTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations, WithoutMiddleware;

    /**
     * @group all
     */
    public function testVerhuurNotificationOut()
    {
        $user = factory(App\User::class)->make();
        $verhuur = factory(App\Verhuring::class)->make([
            'id' => 1
        ]);

        $this->actingAs($user)->visit('/notification/uit/'. $verhuur->id);
    }
    
    /**
     * @group all
     */
    public function testVerhuurNotificationAan()
    {
        $user = factory(App\User::class)->make();
        $verhuur = factory(App\Verhuring::class)->make([
            'id' => 1
        ]);

        $this->actingAs($user)->visit('/notification/aan/'. $verhuur->id);
    }
}
