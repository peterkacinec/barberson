<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $resource = new CategoryCollection(Category::all());

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
