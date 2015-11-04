<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TakkenTest extends TestCase
{
    public function testKapoenenUrl()
    {
        // Front-end
        $this->visit('/takken/kapoenen');
        $this->visit('/takken/welpen');
        $this->visit('/takken/jong-givers');
        $this->visit('/takken/givers');
        $this->visit('/takken/jins');
        $this->visit('/takken/leiding');

        // Back-end
        $this->visit('/backend/takken/update');
        $this->post('/backend/takken/update');
    }
}