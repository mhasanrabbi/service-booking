<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\CreateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function index(UserService $userService)
    {
        return ServiceResource::collection($userService->all());
    }

    public function create(CreateRequest $request, UserService $userService)
    {
        try {
            if ($request->user()->cannot('create', Service::class)) {
                return response()->json([
                    'message' => 'Sorry, you are not permitted to do this action!',
                ], 401);
            }

            $service = $userService->create($request->validated());

            return new ServiceResource($service);
        } catch (Exception $e) {
            Log::error('Service create error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Something went wrong while creating the service.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
