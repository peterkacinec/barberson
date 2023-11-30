<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Common\Infrastructure\OpenApi\OpenApiValidator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(protected OpenApiValidator $openApiValidator)
    {}
}
