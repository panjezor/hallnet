<?php

namespace App\Http\Middleware;

use App\Shortword;
use Closure;
use Illuminate\Http\Request;

class RedirectIfLinkActive
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $shortword = Shortword::firstWhere('short_url', $request->path());
        if ($shortword && $shortword->active) {
            $shortword->counter++;
            $shortword->save();
            return redirect($shortword->long_url);
        }
        return $next($request);
    }
}
