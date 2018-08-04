<?php

namespace TobyMaxham\Helper\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class CloudFlare.
 *
 * @author Tobias Maxham <git2018@maxham.de>
 */
class CloudFlare
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
        if ($request->server('HTTP_X_FORWARDED_PROTO') == 'https') {
            $request->server->set('HTTPS', 'on');
        }

        if (!$request->secure() && env('APP_ENV') === 'production') {
            return Redirect::secure($request->getRequestUri());
        }

        return $next($request);
    }
}
