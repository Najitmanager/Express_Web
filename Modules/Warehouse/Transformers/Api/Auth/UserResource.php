<?php

namespace Modules\Warehouse\Transformers\Api\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Warehouse\Transformers\Api\BranchResource;

class UserResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'role'=>$this->role,
            'branch'=>new BranchResource($this->branches->first()),
            'token' => $this->when($this->token,$this->token),
        ];
    }
}
