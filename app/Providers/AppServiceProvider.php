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
            ->give(config('app.openApiSpecificationPath'));

        $this->app->bind(OpenApiValidatorInterface::class, OpenApiValidator::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
        $this->app->bind(PaymentGatewayInterface::class, PaymentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //        Cashier::calculateTaxes();
        Cashier::useCustomerModel(CustomerUser::class);

        //It will only be enabled outside of production, though.
        Model::preventLazyLoading(! app()->isProduction());
        Model::shouldBeStrict(! app()->isProduction());
    }
}
