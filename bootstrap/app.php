<?php

use App\Http\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Symfony\Component\HttpFoundation\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
        $middleware->authenticateSessions();
        // $middleware->throttleApi();

        $middleware->alias([
            'verified' => EnsureEmailIsVerified::class,
        ]);

        $middleware->redirectUsersTo(function (Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('Already Authenticated')], 409);
            }

            return '/';
        });

        $middleware->redirectGuestsTo(function (Illuminate\Http\Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('Unauthenticated')], 401);
            }

            return '/login';
        });

        $middleware->web(append: [
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->trustProxies(at: '*');

        $middleware->trustProxies(headers: Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_HOST |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO |
            Request::HEADER_X_FORWARDED_AWS_ELB
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Illuminate\Http\Request $request, Throwable $exception) {
            if (! $request->isMethod('GET') || $request->is('api/*')) {
                return true;
            }

            return $request->expectsJson();
        });
    })->create();
