<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function all()
    {
        return Service::all();
    }

    public function create(array $data)
    {
        return DB::transaction(function() use($data) {
            $service = Service::create($data);

            return $service;
        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function() use($id, $data) {
            $service = Service::findOrFail($id);

            $service->update($data);

            return $service;
        });
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
    }
}
