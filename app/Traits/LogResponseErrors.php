<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Exception;

trait LogResponseErrors
{
    /**
     * Log the exception and return a formatted JSON error response.
     *
     * @param Exception $exception
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function errorLogResponse(Exception $exception, string $message, int $status = 500): JsonResponse
    {
        Log::error($message . ': ' . $exception->getMessage(), [
            'trace' => $exception->getTraceAsString(),
        ]);

        return response()->json([
            'message' => $message,
            'error' => $exception->getMessage(),
        ], $status);
    }
}
