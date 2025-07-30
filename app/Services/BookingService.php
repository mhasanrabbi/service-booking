<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function all()
    {
        return Booking::with('service')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    public function create(array $data)
    {
        return DB::transaction(function() use($data) {
            $data = array_merge([
                'user_id' => Auth::id(),
            ], $data);

            $booking = Booking::create($data)->refresh();

            return $booking;
        });
    }
}
