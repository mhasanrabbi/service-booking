<?php

namespace App\Http\Resources;

use App\Enums\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // TODO: HASHED ID
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->label(),
        ];
    }
}
