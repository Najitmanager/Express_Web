<?php

namespace Modules\Warehouse\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class VehicleSearchRequest extends RequestBaseAPI
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => 'bail|required|string'
        ];
    }


}
