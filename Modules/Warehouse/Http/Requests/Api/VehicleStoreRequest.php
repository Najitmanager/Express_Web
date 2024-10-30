<?php

namespace Modules\Warehouse\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends RequestBaseAPI
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
            'model_id' => 'required|integer|exists:models,id',
            'color_id' => 'sometimes|integer|exists:colors,id',
            'year'=>'required|string|digits:4',
            'price'=>'required|integer|digits_between:1,10',
            'weight'=>'required|integer|digits_between:1,5',
            'lot'=>'sometimes',
            'branch_id' => ['required', 'integer', 'exists:branches,id', $this->branchRule()],
        ];
    }

    /**
     * Custom rule for branch_id validation.
     *
     * @return \Closure
     */
    protected function branchRule()
    {
        return function ($attribute, $value, $fail) {
            // Example condition: branch must be active
            $branch = \DB::table('branches')->where('id', $value)->first();

            if ($branch && !auth('api')->user()->branches()->where('branches.id', $branch->id)->exists()) {
                $fail("The selected $attribute is not valid.");
            }
        };
    }
}
