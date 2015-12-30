<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiController extends TestCase
{
    /**
     * @group all
     * @group api
     */
    public function testApiFontPage()
    {
        $data['name'] = 'SIJOT API';
        $data['bugs'] = 'https://github.com/SIJOT/SIJOT-2.x';
        $data['name_developer'] = 'Tim Joosten';
        $data['email']  = 'Topairy@gmail.com';
        $data['twitter'] = '@X0rif';

        $this->visit('/api/v1')
            ->seeJson($data)
            ->seeStatusCode(200);
    }
}
