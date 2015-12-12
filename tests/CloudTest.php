<?php

use Symfony\Component\HttpFoundation\Response;

class CloudTest extends TestCase
{
    /**
     * @geoup backend
     * @group all
     */
    public function testIndex()
    {
        $this->visit('/cloud/index')->seeStatusCode(Response::HTTP_OK);
    }

    /**
     * @group backend
     * @group all
     */
    public function testDeleteFile()
    {

    }

    /**
     * @group backend
     * @group all
     */
    public function testHyperlinks()
    {
        // Navbar

        // Content
    }
}
