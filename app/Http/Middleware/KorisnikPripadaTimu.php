<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KorisnikPripadaTimu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $korisnik = $request->user();

        if ($korisnik->tim == null) {
            return response()->json(['poruka'=> 'Niste dodeljeni nijednom timu. Kontaktirajte menadzera da vas ubaci u tim.'],422);
        }

        return $next($request);
    }
}
