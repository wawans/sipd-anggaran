<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureMacros();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }

    protected function configureMacros(): void
    {
        Route::macro('bulkResource', function ($uri, $controller, $name = null, $path = 'bulk') {
            Route::post("$uri/$path", [$controller, 'stores'])->name(($name ?? $uri).'.stores');
            Route::put("$uri/$path", [$controller, 'updates'])->name(($name ?? $uri).'.updates');
            Route::delete("$uri/$path", [$controller, 'destroys'])->name(($name ?? $uri).'.destroys');
        });

        Route::macro('exportImport', function ($uri, $controller, $name = null) {
            Route::post("$uri/import", [$controller, 'import'])->name(($name ?? $uri).'.import');
            Route::get("$uri/export/template", [$controller, 'template'])->name(($name ?? $uri).'.export.template');
            Route::get("$uri/export", [$controller, 'export'])->name(($name ?? $uri).'.export');
        });
    }
}
