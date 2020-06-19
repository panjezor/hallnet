<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

/** Default robot middleware extension for the site.
 * used with spatie/laravel-robots-middleware
 */
class MyRobotsMiddleware extends RobotsMiddleware
{
    /**
     * @return string|bool
     */
    protected function shouldIndex(Request $request)
    {
        return $request->segment(1) !== 'admin';
    }
}