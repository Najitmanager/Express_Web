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
    /* =================> Attributes <=====================*/

    public function getNameAttribute()
    {
        return "{$this->year} {$this->model->make->name} {$this->model->name}";
    }

    /* =============> Relations <========================= */
    public function model(){
        return $this->belongsTo(\Modules\Warehouse\Entities\Model::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
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
