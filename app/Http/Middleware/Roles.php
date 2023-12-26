<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // if (auth()->user()->role == $role) {
        //     return $next($request);
        // }

        // Periksa apakah pengguna memiliki role yang diizinkan
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }
        // return redirect(route('dashboard'))->with('error', 'Unauthorized action!');
        return abort(403, 'FORBIDDEN');
    }
}
