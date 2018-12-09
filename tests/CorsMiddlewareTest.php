<?php

namespace TobyMaxham\Helper\Tests;

class CorsMiddlewareTest extends TestCase
{
    /** @test */
    public function check_access_origin()
    {
        config(['tma-helper.cors.allowedOrigins' => ['localhost']]);
        $crawler = $this->call('GET', 'api/ping');
        $this->assertEquals('localhost', $crawler->headers->get('Access-Control-Allow-Origin'));
        $this->assertEquals(200, $crawler->getStatusCode());
    }
}
