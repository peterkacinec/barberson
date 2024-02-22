<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResendEmailVerificationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return new JsonResponse(true, Response::HTTP_OK);
    }
}
