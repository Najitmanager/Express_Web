<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrier extends Model
{
    use HasFactory;

    protected $fillable = ['name','tracking_url','active'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\CarrierFactory::new();
    }



}
