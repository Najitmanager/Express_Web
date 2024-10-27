<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Country;

class Consignee extends Model
{
    use HasFactory;

    protected $fillable = ['name','city','country_id','phone','address','active'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\ConsigneeFactory::new();
    }

    /* ========================> Relations <========================= */
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
