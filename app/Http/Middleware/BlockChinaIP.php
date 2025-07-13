<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GeoIp2\Database\Reader;

class BlockChinaIP
{
    public function handle(Request $request, Closure $next)
    {
    if (app()->environment('local')) {
            return $next($request);

        }
        $location = geoip()->getLocation();

    if ($location->country === 'China') {
        abort(403, 'Access denied from your region');
    }
    return $next($request);
    }
}