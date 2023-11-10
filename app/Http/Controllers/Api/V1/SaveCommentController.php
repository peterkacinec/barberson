<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCommentRequest;
use App\Http\Resources\V1\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class SaveCommentController extends Controller
{
    public function __invoke(SaveCommentRequest $request): JsonResource
    {
        return new CommentResource(Comment::create($request->validated()));
    }
}
