<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentCollection;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $resource = new CommentCollection(Comment::all());

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
