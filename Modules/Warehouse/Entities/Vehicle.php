<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Client;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected  $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\VehicleFactory::new();
    }

    /* =============> Relations <========================= */
    public function make()
    {
        return $this->belongsTo(Make::class);
    }
    public function model(){
        return $this->belongsTo(Model::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function customer(){
        return $this->belongsTo(Client::class);
    }
    public function port(){
        return $this->belongsTo(Port::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
}
