<?php

use App\Http\Middleware\ForceXmlHttpRequest;
use App\Http\Middleware\KorisnikPripadaTimu;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        /**
         * Middleware koji sluzi da svaki request tumaci kao API request
         */
        $middleware->append(ForceXmlHttpRequest::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        /**
         * Custom handle-ovanje not found izuzetka
         */
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'poruka' => 'Resurs nije pronadjen.'
                ], 404);
            }
        });

        /**
         * Custom handle-ovanje method not allowed izuzetka
         */
        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json(['poruka' => $e->getMessage()], 405);
        });
    })->create();
