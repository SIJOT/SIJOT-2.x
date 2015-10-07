<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TakkenTest extends TestCase
{
    public function testKapoenenUrl()
    {
        $this->visit('/takken/kapoenen');
    }

    public function testWelpenUrl()
    {
        $this->visit('/takken/welpen');
    }

    public function testJongGiverUri()
    {
        $this->visit('/takken/jong-givers');
    }

    public function testGiversUri()
    {
        $this->visit('/takken/givers');
    }

    public function testJinsUri()
    {
        $this->visit('/takken/jins');
    }

    public function testLeidingUri()
    {
        $this->visit('/takken/leiding');
    }
}