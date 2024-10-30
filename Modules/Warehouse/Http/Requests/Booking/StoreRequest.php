<?php

namespace Modules\Warehouse\Http\Requests\Booking;

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
            'booking_no'=>'required|unique:bookings,booking_no',
            'booking_date'=>'required|date|date_format:Y-m-d|after_or_equal:today',
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
