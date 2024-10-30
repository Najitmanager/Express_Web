<?php

namespace Modules\Warehouse\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class VehiclePhotosRequest extends RequestBaseAPI
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:photos,keys,titles,bill_of_lading',
            'photos' => ['required','array',$this->photosRule()],
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Custom rule for branch_id validation.
     *
     * @return \Closure
     */
    protected function photosRule()
    {
        return function ($attribute, $value, $fail) {
            if ($this->input('type') === 'photos' && count($value)<2) {
                $fail("The selected $attribute must be at least 20 photo.");
            }elseif ($this->input('type') === 'bill_of_lading' && (count($value)> 1 || count($value) == 0)) {
                $fail("The selected $attribute must be at maximum 1 photo.");
            }
        };
    }


}
