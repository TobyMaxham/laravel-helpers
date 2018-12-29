<?php

namespace TobyMaxham\Helper\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class Cors.
 *
 * @author Tobias Maxham <git2019@maxham.de>
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
        if (! method_exists($response, 'header')) {
            return $response;
        }

        return $this->addCorsHeaders($response);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response $response
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    private function addCorsHeaders($response)
    {
        if (! $response->headers->has('Access-Control-Allow-Origin')) {
            $response = $response->header('Access-Control-Allow-Origin', config('tma-helper.cors.allowedOrigins', 'localhost'))
                ->header('Access-Control-Allow-Methods', config('tma-helper.cors.allowedMethods'));
        }

        return $response;
    }
}
