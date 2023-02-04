<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'phone' => 'required|max:255|unique:users',
            'password' => 'required',
            'type' => 'nullable|string',
        ];
    }
}
