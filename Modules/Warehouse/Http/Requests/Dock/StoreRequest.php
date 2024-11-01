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
            'document_no'=>'required|unique:docks,document_no',
            'booking_id'=>'required|exists:bookings,id',
            'container_no'=>'sometimes|string',
            'seal_no'=>'sometimes|string',
            'aes_no'=>'sometimes|string',
            'type_of_moves'=>'sometimes|string',
            'terminal'=>'sometimes|string',
            'container_size'=>'sometimes|string',
            'booking_received'=>'sometimes|boolean',
            'load_plan_received'=>'sometimes|boolean',
            'loading_date'=>'sometimes|date',
            'in_gate_date'=>'sometimes|date',
            'departure_date'=>'sometimes|date',
            'client_id'=>'required|exists:clients,id',
            'consignee_id'=>'sometimes|exists:consignees,id',
            'notify_party'=>'sometimes|string',
            'truck_company_id'=>'sometimes|exists:truck_companies,id',
            'carrier_id'=>'sometimes|exists:carriers,id',
            'vessel_name'=>'sometimes|string',
            'voyage'=>'sometimes|string',
            'port_id'=>'required|exists:ports,id',
            'vehicles'=>'sometimes|array',
            'vehicles.*'=>'sometimes|exists:vehicles,id',
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
