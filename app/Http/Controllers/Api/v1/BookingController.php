<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use App\Traits\LogResponseErrors;
use Exception;

class BookingController extends Controller
{
    use LogResponseErrors;

    public function index(BookingService $bookingService)
    {
       return BookingResource::collection($bookingService->all());
    }

    public function store(StoreRequest $request, BookingService $bookingService)
    {
        try {
            $booking = $bookingService->create($request->validated());

            return new BookingResource($booking);
        } catch (Exception $e) {
            return $this->errorLogResponse($e, 'Something went wrong while creating the service.');
        }
    }
}
