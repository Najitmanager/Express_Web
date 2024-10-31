<?php

namespace Modules\Warehouse\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DockResource extends JsonResource
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
            'document_no'=>$this->document_no,
            'booking_no'=>$this->booking->booking_no,
            'container_no'=>$this->container_no,
            'loading_date'=>$this->loading_date,
            'photos_no'=>$this->total_photos_no,
            'client'=>[
                'id'=>$this->client->id,
                'company_name'=>$this->client->user->name,
                'contact_full_name'=>$this->client->contact_full_name
            ],
            'container_photos'=>[
                'total'=>$this->getMedia('container_photos')->count(),
                'images'=>$this->getMedia('container_photos')->map(function ($media) {
                    return [
                        'url' => $media->getUrl(), // Full URL to the image
                        'name' => $media->name, // Optional: name of the media file
                        'size' => $media->size, // Optional: size of the media file in bytes
                    ];
                }),
            ],
            'seal_photos'=>[
                'total'=>$this->getMedia('seal_photos')->count(),
                'images'=>$this->getMedia('seal_photos')->map(function ($media) {
                    return [
                        'url' => $media->getUrl(), // Full URL to the image
                        'name' => $media->name, // Optional: name of the media file
                        'size' => $media->size, // Optional: size of the media file in bytes
                    ];
                }),
            ],
            'loading_photos'=>[
                'total'=>$this->getMedia('loading_photos')->count(),
                'images'=>$this->getMedia('loading_photos')->map(function ($media) {
                    return [
                        'url' => $media->getUrl(), // Full URL to the image
                        'name' => $media->name, // Optional: name of the media file
                        'size' => $media->size, // Optional: size of the media file in bytes
                    ];
                }),
            ],
            'vehicles'=>$this->vehicles->map(function ($vehicle) {
                return [
                    'id'=>$vehicle->id,
                    'name'=>$vehicle->name,
                    'vin'=>$vehicle->vin,
                    'main'=>$vehicle->getFirstMediaUrl('main'),
                    'color'=>!is_null($vehicle->color)?$vehicle->color->name:'---------',
                    'color_value'=>!is_null($vehicle->color)?$vehicle->color->value:'',
                ];
            })

        ];
    }
}
