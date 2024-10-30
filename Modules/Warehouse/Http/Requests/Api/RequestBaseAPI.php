<?php

namespace Modules\Warehouse\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RequestBaseAPI extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function expectsJson(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        $data['data'] = null;
        $data['status'] = "validation_errors";
        $data['message'] = $validator->errors()->first();
        throw new HttpResponseException(response()->json($data, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)); // 422
    }
}
