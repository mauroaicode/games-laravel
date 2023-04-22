<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GameRequest extends FormRequest
{public function authorize(): bool
{
    return true;
}
    //Validaciones cuando se realicen las peticiones request
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                "max:255",
            ],
            "description" => "required|string",
            "pathImage" => "required",
            "url" => "required|string",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'response' => 'error_form',
            'data' => $validator->errors()

        ], 400));
    }
}
