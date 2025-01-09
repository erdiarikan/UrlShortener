<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class DecodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'short_url' => 'required|url',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'message' => 'Validation error.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
