<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->user()->tokens()->delete();
        } catch (Exception $exception) {
            Log::error(
                "Some error during the customer logout, reason: {$exception->getMessage()}",
                [
                    'message_type' => self::class
                ]
            );

            return new JsonResponse(false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(true, Response::HTTP_OK);
    }
}
