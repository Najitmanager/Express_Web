<?php

namespace Modules\Warehouse\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Warehouse\Transformers\Api\Auth\UserResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'main'=>$this->getFirstMediaUrl('main'),
            'name'=>$this->name,
            'vin'=>$this->vin,
            'photos_count'=>!is_null($this->photos)?count($this->photos):0,
            'color'=>$this->when($this->color,$this->color->name),
            'color_value'=>'#ffffff',
            'expected_arrival_date'=>$this->expected_arrival_date,
            'arrival_date'=>optional($this->workflow)->arrival_date,
            'client'=>[
                'id'=>$this->client->id,
                'company_name'=>$this->client->user->name,
                'contact_full_name'=>$this->client->contact_full_name
            ]

        ];
    }
}
