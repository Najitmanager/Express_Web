<?php

namespace Modules\Warehouse\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ContainerPhotosRequest extends RequestBaseAPI
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:container_photos,seal_photos,loading_photos',
            'photos' => ['required','array'],
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }


}
