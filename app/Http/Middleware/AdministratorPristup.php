<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministratorPristup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $korisnik = $request->user();

        if ($korisnik->uloga_id != 1) {
            return response()->json(['poruka' => 'Pristup je dozvoljen samo Administratoru aplikacije!'], 403);
        }

        return $next($request);
    }
}
