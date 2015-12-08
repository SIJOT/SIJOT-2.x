<?php


class CloudTest extends TestCase
{
    /**
     * @group all
     */
    public function testIndex()
    {
        $this->visit('/cloud/index')->seeStatusCode(self::HTTP_OK);
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
