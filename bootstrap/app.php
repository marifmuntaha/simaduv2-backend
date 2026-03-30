<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
//        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withBroadcasting(
        __DIR__ . '/../routes/channels.php',
        ['prefix' => 'api', 'middleware' => ['api', 'auth:sanctum']],
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'statusMessage' => $e->validator->errors()->first(),
            ], 442);
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'status' => 'error',
                'statusMessage' => 'Sumber Daya atau Rute tidak ditemukan.',
                'result' => null,
            ], 404);
        });
        $exceptions->render(function (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'statusMessage' => $e->getMessage() ?: 'Internal Server Error',
                'result' => config('app.debug') ? $e->getTrace() : null, // Trace hanya muncul saat mode debug
            ], 500);
        });
    })
    ->withEvents(discover: [
        __DIR__ . '/../app/Listeners'
    ])
    ->create();
