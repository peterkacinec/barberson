<?php

namespace App\Providers;

use App\Common\Infrastructure\OpenApi\OpenApiValidator;
use App\Common\Infrastructure\OpenApi\OpenApiValidatorInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OpenApiValidatorInterface::class, OpenApiValidator::class);
    }
}
