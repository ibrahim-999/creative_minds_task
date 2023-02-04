<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\ApiFormRequest;
use Twilio\Rest\Api;

class LoginRequest extends ApiFormRequest
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
            'phone' => 'required|exists:users',
            'password' => 'required'
        ];
    }
}
