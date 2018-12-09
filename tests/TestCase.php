<?php

namespace TobyMaxham\Helper\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use TobyMaxham\Helper\Http\Middleware\Cors;

/**
 * Class TestCase
 * @package TobyMaxham\Helper\Test
 * @author Tobias Maxham <git2018@maxham.de>
 */
class TestCase extends Orchestra
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function getEnvironmentSetUp($app)
    {
        $router = $app['router'];
        $this->addApiRoutes($router);
    }

    private function addApiRoutes($router)
    {
        $router->group(['middleware' => Cors::class], function () use ($router) {
            $router->get('api/ping', [
                'as' => 'api.ping',
                'uses' => function () {
                    return 'pong';
                }
            ]);
        });
    }
}
