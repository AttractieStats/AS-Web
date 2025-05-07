<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\User;


class SetUserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    if (auth()->check() && in_array(auth()->user()->language, ['nl', 'en', 'de'])) {
        app()->setLocale(auth()->user()->language);
    }

    return $next($request);
}

}
