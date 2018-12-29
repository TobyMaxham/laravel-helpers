<?php

namespace TobyMaxham\Helper\Http\Middleware;

use Illuminate\Http\JsonResponse;

/**
 * @author Tobias Maxham <git2019@maxham.de>
 */
class PrettyPrint
{
    const QUERY_PARAMETER = 'pretty';

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
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
