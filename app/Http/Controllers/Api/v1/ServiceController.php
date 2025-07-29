<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\CreateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\UserService;
use App\Traits\LogResponseErrors;
use Exception;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    use LogResponseErrors;

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
            return $this->errorLogResponse($e, 'Something went wrong while creating the service.');
        }
    }
}
