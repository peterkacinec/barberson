<?php

declare(strict_types=1);

namespace App\Providers;

use App\Common\Application\OpenApiValidatorInterface;
use App\Common\Application\TransactionServiceInterface;
use App\Common\Infrastructure\Eloquent\Transaction\TransactionService;
use App\Common\Infrastructure\OpenApi\OpenApiValidator;
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
            ->give(config('app.openApiSpecifacationPath'));

        $this->app->bind(OpenApiValidatorInterface::class, OpenApiValidator::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
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
