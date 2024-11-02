<?php

namespace Modules\Warehouse\Http\Requests\Dock;

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
            'document_no'=>'required',
            'booking_id'=>'required|exists:bookings,id',
            'container_no'=>'nullable|string',
            'seal_no'=>'nullable|string',
            'aes_no'=>'nullable|string',
            'type_of_moves'=>'nullable|string',
            'terminal'=>'nullable|string',
            'container_size'=>'nullable|string',
            'booking_received'=>'nullable|boolean',
            'load_plan_received'=>'nullable|boolean',
            'loading_date'=>'nullable|date',
            'in_gate_date'=>'nullable|date',
            'departure_date'=>'nullable|date',
            'client_id'=>'nullable|exists:clients,id',
            'consignee_id'=>'nullable|exists:consignees,id',
            'notify_party'=>'nullable|string',
            'truck_company_id'=>'nullable|exists:truck_companies,id',
            'carrier_id'=>'nullable|exists:carriers,id',
            'vessel_name'=>'nullable|string',
            'voyage'=>'nullable|string',
//            'port_id'=>'required|exists:ports,id',
//            'vehicles'=>'nullable|array',
//            'vehicles.*'=>'nullable|exists:vehicles,id',
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
