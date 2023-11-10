<?php

declare(strict_types=1);

namespace App\Providers;

use App\Common\Infrastructure\OpenApi\OpenApiValidator;
use App\Common\Infrastructure\OpenApi\OpenApiValidatorInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->when(OpenApiValidator::class)
            ->needs('$pathToOpenApiSpec')
            ->give('../storage/api/api.yaml');

        $this->app->bind(OpenApiValidatorInterface::class, OpenApiValidator::class);

        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());

        Model::shouldBeStrict(
//         It will only be enabled outside of production, though.
            ! app()->isProduction()
        );
    }
}
