<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        // Version 1 api documentation setup
        Scramble::registerApi('v1', ['info' => ['version', '1.0']])
        ->expose(
            ui: '/docs/api/v1',
            document: '/docs/api/v1/openapi.json'
        )
        ->routes(function (Route $route) {
            return Str::startsWith($route->uri, 'api/v1');
        })
        ->afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->secure(SecurityScheme::http('bearer'));
        });
    }
}
