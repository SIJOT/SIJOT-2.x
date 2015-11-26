<?php


class CloudTest extends TestCase
{
    /**
     * @group all
     */
    public function testCloudRoutes()
    {
        $this->visit('/cloud/index');
        $this->visit('/cloud/download/1');
        $this->visit('/cloud/delete/1');
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
