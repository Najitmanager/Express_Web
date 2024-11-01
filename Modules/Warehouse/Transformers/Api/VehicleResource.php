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
            'color'=>!is_null($this->color)?$this->color->name:'---------',
            'color_value'=>!is_null($this->color)?$this->color->value:'',
            'expected_arrival_date'=>$this->expected_arrival_date,
            'arrival_date'=>optional($this->workflow)->arrival_date,
            'client'=>[
                'id'=>$this->client->id,
                'company_name'=>$this->client->user->name,
                'contact_full_name'=>$this->client->contact_full_name
            ],
            'bill_of_lading'=>$this->getFirstMediaUrl('bill_of_lading'),
            'photos'=>[
                'total'=>$this->getMedia('photos')->count(),
                'images'=>$this->getMedia('photos')->map(function ($media) {
                    return [
                        'url' => $media->getUrl(), // Full URL to the image
                        'name' => $media->name, // Optional: name of the media file
                        'size' => $media->size, // Optional: size of the media file in bytes
                    ];
                }),
            ],
            'keys'=>[
                'total'=>$this->getMedia('keys')->count(),
                'images'=>$this->getMedia('keys')->map(function ($media) {
                    return [
                        'url' => $media->getUrl(), // Full URL to the image
                        'name' => $media->name, // Optional: name of the media file
                        'size' => $media->size, // Optional: size of the media file in bytes
                    ];
                }),
            ],
            'titles'=>[
                'total'=>$this->getMedia('titles')->count(),
                'images'=>$this->getMedia('titles')->map(function ($media) {
                    return [
                        'url' => $media->getUrl(), // Full URL to the image
                        'name' => $media->name, // Optional: name of the media file
                        'size' => $media->size, // Optional: size of the media file in bytes
                    ];
                }),
            ],


        ];
    }
}
