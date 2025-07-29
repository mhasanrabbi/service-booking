<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\CreateRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\UserService;
use App\Traits\LogResponseErrors;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    use LogResponseErrors;

    public function index(UserService $userService)
    {
        return ServiceResource::collection($userService->all());
    }

    public function store(CreateRequest $request, UserService $userService)
    {
        try {
            $service = $userService->create($request->validated());

            return new ServiceResource($service);
        } catch (Exception $e) {
            return $this->errorLogResponse($e, 'Something went wrong while creating the service.');
        }
    }

    public function update(UpdateRequest $request, UserService $userService)
    {
        try {
            $service = $userService->update($request->route('id'), $request->validated());

            return new ServiceResource($service);
        } catch (Exception $e) {
            return $this->errorLogResponse($e, 'Something went wrong while updating the service.');
        }
    }
}
