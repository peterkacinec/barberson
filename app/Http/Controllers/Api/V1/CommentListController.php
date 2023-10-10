<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentCollection;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentListController extends Controller
{
    public function __invoke(): JsonResource
    {
        return new CommentCollection(Comment::all());
    }
}
