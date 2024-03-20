<?php

declare(strict_types=1);

namespace App\Providers;

use App\Common\Application\OpenApiValidatorInterface;
use App\Common\Application\PaymentGatewayInterface;
use App\Common\Application\TransactionServiceInterface;
use App\Common\Infrastructure\Eloquent\Transaction\TransactionService;
use App\Common\Infrastructure\OpenApi\OpenApiValidator;
use App\Models\CustomerUser;
use App\Services\PaymentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use L5Swagger\L5SwaggerServiceProvider;
use Laravel\Cashier\Cashier;

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
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
        $this->app->bind(PaymentGatewayInterface::class, PaymentService::class);

        $this->app->register(L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Cashier::calculateTaxes();
        Cashier::useCustomerModel(CustomerUser::class);

        Model::preventLazyLoading(! app()->isProduction());

        Model::shouldBeStrict(
//         It will only be enabled outside of production, though.
            ! app()->isProduction()
        );
    }
}
