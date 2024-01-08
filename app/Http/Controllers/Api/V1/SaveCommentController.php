<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class SaveCommentController extends Controller
{
    public function __invoke(SaveCommentRequest $request): JsonResponse
    {
        $loggedUserId = $request->user()->id;

        Comment::create(
            [
                ...$request->validated(),
                'customer_id' => $loggedUserId,
            ]
        );

        return new JsonResponse(true);
    }
}
