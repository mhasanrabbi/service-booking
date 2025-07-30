<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BookingResource;
use App\Models\Booking;
use App\Traits\LogResponseErrors;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    use LogResponseErrors;

    public function index()
    {
        if (Auth::user()->role !== UserRoles::ADMIN) {
            return response()->json([
                'message' => 'You are not authorize.'
            ], 403);
        }

       return BookingResource::collection(Booking::all());
    }
}
