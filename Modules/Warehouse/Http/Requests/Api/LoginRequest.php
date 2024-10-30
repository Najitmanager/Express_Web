<?php

namespace Modules\Warehouse\Http\Requests\Api;

class LoginRequest extends RequestBaseAPI
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email',
            'password'=>'required|string'

        ];
    }

}
