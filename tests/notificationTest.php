<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class notificationTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVerhuurNotificationOut()
    {
        $this->visit('/notification/uit/1');
    }

    public function testVerhuurNotificationAan()
    {
        $this->visit('/notification/aan/1');
    }
}
