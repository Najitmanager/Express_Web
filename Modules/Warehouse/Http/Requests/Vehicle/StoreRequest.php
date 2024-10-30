<?php

namespace Modules\Warehouse\Http\Requests\Vehicle;

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
            'vin' => 'required',
            'type_id' => 'required|integer|exists:types,id',
            'make_id' => 'required|integer|exists:makes,id',
            'color_id' => 'required|integer|exists:colors,id',
            'model_id' => 'required|integer|exists:models,id',
            'year'=>'required|integer|digits:4',
            'price'=>'required|integer|digits_between:1,2',
            'weight'=>'required|integer|digits_between:1,2',
            'client_id' => 'required|integer|exists:clients,id',
            'port_id' => 'required|integer|exists:ports,id',
            'expected_arrival_date'=>'sometimes|date',
            'lot'=>'sometimes',
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
