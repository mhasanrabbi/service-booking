<?php

namespace App\Http\Requests\Service;

use App\Enums\ServiceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('services', 'name')->ignore($id),
            ],
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'status' => ['required', new Enum(ServiceStatus::class)],
        ];
    }
}
