<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenadzerPristup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $korisnik = $request->user();

        if ($korisnik->uloga_id != 2) {
            return response()->json(['poruka' => 'Pristup je dozvoljen samo Menadzeru tima!'], 403);
        }

        return $next($request);
    }
}
