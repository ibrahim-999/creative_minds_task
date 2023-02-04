<?php

namespace App\Http\Exceptions;

use App\Libraries\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ApiValidationException extends ValidationException
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function render(): Response
    {
        $error_messages = $this->validator->errors()->toArray();

        return ApiResponse::fail($error_messages, 422);
    }
}
