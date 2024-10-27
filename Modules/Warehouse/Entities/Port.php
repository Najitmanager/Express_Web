<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Country;

class Port extends Model
{
    use HasFactory;

    protected $fillable = ['name','country_id','city','active'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\PortFactory::new();
    }

    /* =================> Relations <========================= */
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
