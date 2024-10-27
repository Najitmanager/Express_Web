<?php

namespace Modules\Warehouse\Http\Requests\TruckCompany;

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
            'company_name' => 'required|string|max:255',
            'contact_full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:255',
            'zip' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'phones'=>'sometimes|string|max:255',
            'email'=>'sometimes|string|max:255',
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
