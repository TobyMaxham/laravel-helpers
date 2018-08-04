<?php

namespace TobyMaxham\Helper\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Cors.
 *
 * @author Tobias Maxham <git2018@maxham.de>
 */
class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        return $this->addCorsHeaders($response);
    }

    /**
     * @param Response $response
     *
     * @return Response
     */
    private function addCorsHeaders(Response $response)
    {
        if (!$response->headers->has('Access-Control-Allow-Origin')) {
            $response = $response->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS');
        }

        return $response;
    }
}
