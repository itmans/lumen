<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('APP_DEBUG')) {
            Log::debug("\n\n");
            Log::debug('URL: '. $request->url());
            $params = $request->all();
            if (!empty($params)) {
                Log::debug("PARAMS: ". var_export($params, true));
            } else {
                Log::debug("PARAMS: ");
            }
        }
        return $next($request);
    }
}
