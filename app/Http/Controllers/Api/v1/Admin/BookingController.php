<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BookingResource;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'service'])->get();

        return BookingResource::collection($bookings);
    }
}
