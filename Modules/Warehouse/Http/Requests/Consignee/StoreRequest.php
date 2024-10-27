<?php

namespace Modules\Warehouse\Http\Requests\Consignee;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'country_id'=>'required|integer|exists:countries,id',
            'city'=>'required|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
