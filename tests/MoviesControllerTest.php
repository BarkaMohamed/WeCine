<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MoviesControllerTest extends WebTestCase
{

    /**
     * @var KernelBrowser
     */
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        self::ensureKernelShutdown();

        $this->client = static::createClient();
    }

    /**
     * test Gender List
     */
    public function testGenderList()
    {
        $this->client->request('GET', '/api/movies/gender/list');

        $response = $this->client->getResponse();

        $this->assertJson($response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($this->client->getResponse()->getContent());
        $this->assertEquals(
            (object)['id' => '28', 'name' => 'Action'],
            $data[0]
        );
    }

    /**
     * test Gender List
     */
    public function testMoviesByGender()
    {
        $this->client->request('GET', '/api/movies/by/gender?id[28]');

        $response = $this->client->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($this->client->getResponse()->getContent());
        $this->assertCount(20, $data);
    }

    /**
     * test Best Movie
     */
    public function testBestMovie()
    {
        $this->client->request('GET', '/api/movies/best');

        $response = $this->client->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($this->client->getResponse()->getContent());
        $this->assertEquals(278, $data->id);
    }

    /**
     * test Movies Videos
     */
    public function testMoviesVideos()
    {
        $this->client->request('GET', '/api/movies/videos/550');

        $response = $this->client->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($this->client->getResponse()->getContent());
        $this->assertEquals('BdJKm16Co6M', $data->key);
    }

    /**
     * test Movies Search
     */
    public function testMoviesSearch()
    {
        $this->client->request('GET', '/api/movies/search/lucy');

        $response = $this->client->getResponse();
        $this->assertJson($response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($this->client->getResponse()->getContent());
        $this->assertCount(20, $data);
    }


}