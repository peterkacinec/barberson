<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\V1\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentSaveController extends Controller
{
    public function __invoke(StoreCommentRequest $request): JsonResource
    {
        return new CommentResource(Comment::create($request->validated()));
    }
}
