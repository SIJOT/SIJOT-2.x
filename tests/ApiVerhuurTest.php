<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiVerhuurTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions, DatabaseMigrations;

    /**
     * @group all
     * @group api
     */
    public function testApiRentalIndex()
    {
        factory(App\Verhuring::class, 1)->create([
            'id' => 1,
            'Email' => 'test@domain.be',
        ]);

        $response = $this->call('GET', '/api/v1/verhuring');
        $array = json_decode($response->getContent(), true);

        $this->assertNotEmpty($array);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(sizeof($array) > 0);

        $dataInfo = $array['data'][0];
        $dataDate = $array['data'][0]['datum'];

        $this->assertArrayHasKey('id', $dataInfo);
        $this->assertArrayhasKey('status', $dataInfo);

        $this->assertArrayHasKey('start', $dataDate);
        $this->assertArrayHasKey('eind', $dataDate);
    }

    /**
     * @group all
     * @group api
     */
    public function testApiRentalSpecific()
    {
        $rental = factory(App\Verhuring::class, 1)->create([
            'id' => 1,
            'Email' => 'test@domain.be',
        ]);

        $response = $this->call('GET', '/api/v1/verhuring/'. $rental->id);
        $array = json_decode($response->getContent(), true);

        $this->assertNotEmpty($array);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(sizeof($array) > 0);

        $dataInfo = $array['data'][0];
        $dataDate = $array['data'][0]['datum'];

        $this->assertArrayHasKey('id', $dataInfo);
        $this->assertArrayhasKey('status', $dataInfo);

        $this->assertArrayHasKey('start', $dataDate);
        $this->assertArrayHasKey('eind', $dataDate);

        // Test when no data will be returned.
        $responseTwo = $this->call('GET', '/api/v1/verhuring/5');
        $arrayTwo = json_decode($responseTwo->getContent(), true);

        $this->assertNotEmpty($arrayTwo);
        $this->assertArrayHasKey('errors', $arrayTwo);
        $this->assertArrayHasKey('message', $arrayTwo['errors'][0]);

    }
}
