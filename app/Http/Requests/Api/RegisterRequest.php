<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiFormRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'phone' => 'required', 'max:255', Rule::unique(User::class),
            'password' => 'required',
        ];
    }
}
