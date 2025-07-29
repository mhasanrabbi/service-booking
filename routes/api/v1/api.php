<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ServiceController;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/services', [ServiceController::class, 'index']);
    Route::post('/services', [ServiceController::class, 'store'])->can('create', Service::class);
    Route::put('/services/{id}', [ServiceController::class, 'update'])->can('update', Service::class);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->can('delete', Service::class);
});


Route::get('test', function () {
    return response()->json(['message' => 'API v1 working!']);
});
