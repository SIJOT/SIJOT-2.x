<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class notificationTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * @group all
     */
    public function testVerhuurNotificationOut()
    {
        $this->visit('/notification/uit/1');
    }
    
    /**
     * @group all
     */
    public function testVerhuurNotificationAan()
    {
        $this->visit('/notification/aan/1');
    }
}
