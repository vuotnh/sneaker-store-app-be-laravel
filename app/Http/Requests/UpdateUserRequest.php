<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            'firstName' => 'sometimes|required|max:255',
            'lastName' => 'sometimes|required|max:255',
            'location' => 'sometimes|required|max:255',
            'phone' => 'sometimes|required|max:255',
            'password' => 'sometimes|required|max:255',
            'avatar_id' => 'sometimes|required|max:1000',
        ];
    }
}
