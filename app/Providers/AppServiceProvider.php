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
        Route::macro('bulkResource', function ($uri, $controller) {
            Route::post($uri, [$controller, 'stores'])->name("$uri.stores");
            Route::put($uri, [$controller, 'updates'])->name("$uri.updates");
            Route::delete($uri, [$controller, 'destroys'])->name("$uri.destroys");
        });

        Route::macro('exportImport', function ($uri, $controller) {
            Route::post("$uri/import", [$controller, 'import'])->name("$uri.import");
            Route::get("$uri/export/template", [$controller, 'template'])->name("$uri.export.template");
            Route::get("$uri/export", [$controller, 'export'])->name("$uri.export");
        });
    }
}
