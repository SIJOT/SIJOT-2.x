<?php

use Symfony\Component\HttpFoundation\Response;

class CloudTest extends TestCase
{
    /**
     * @group all
     */
    public function testIndex()
    {
        $this->visit('/cloud/index')->seeStatusCode(Response::HTTP_OK);
    }

    public function testDeleteFile()
    {

    }

    /**
     * @group all
     */
    public function testHyperlinks()
    {
        // Navbar

        // Content
    }
}
