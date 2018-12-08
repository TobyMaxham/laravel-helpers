<?php

namespace TobyMaxham\Helper\Http\Middleware;

use Illuminate\Http\JsonResponse;

class PrettyPrint
{
    const QUERY_PARAMETER = 'pretty';

    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            if ('true' == $request->query(self::QUERY_PARAMETER)) {
                $response->setEncodingOptions(JSON_PRETTY_PRINT);
            }
        }

        return $response;
    }
}
