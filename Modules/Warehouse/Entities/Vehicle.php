<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Client;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Vehicle extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [];
    protected  $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')->singleFile();
        $this->addMediaCollection('bill_of_lading')->singleFile();
        $this->addMediaCollection('photos');
        $this->addMediaCollection('titles');
        $this->addMediaCollection('keys');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }
    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\VehicleFactory::new();
    }
    /* =================> Attributes <=====================*/

    public function getNameAttribute()
    {
        return "{$this->year} {$this->model->make->name} {$this->model->name}";
    }
    public function getTotalPhotosNoAttribute()
    {
        $sum = count($this->getMedia('photos'));
        $sum += $this->getFirstMediaUrl('main')?1:0;
        $sum += $this->getFirstMediaUrl('bill_of_lading')?1:0;
        return $sum;
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
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function color(){
        return $this->belongsTo(Color::class,'color_id');
    }
    public function workflow()
    {
        return $this->hasOne(Workflow::class,'vehicle_id');
    }
}
