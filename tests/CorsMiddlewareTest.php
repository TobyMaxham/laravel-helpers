<?php

namespace TobyMaxham\Helper\Tests;

use Illuminate\Support\Facades\Request;
use TobyMaxham\Helper\Http\Middleware\Cors;

/**
 * Class CorsMiddlewareTest
 * @package ${NAMESPACE}
 * @author Tobias Maxham <git2018@maxham.de>
 */
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