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

class Dock extends Model implements HasMedia
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
        return \Modules\Warehouse\Database\factories\DockFactory::new();
    }
    /* ===================================> Attributes <================== */
    public function getTotalPhotosNoAttribute()
    {
        $sum = count($this->getMedia('photos'));
        $sum += $this->getFirstMediaUrl('main')?1:0;
        $sum += $this->getFirstMediaUrl('bill_of_lading')?1:0;
        return $sum;
    }

    /* ===========================> Relations <========================= */
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class,'booking_id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function consignee()
    {
        return $this->belongsTo(Consignee::class,'consignee_id');
    }
    public function truck_company()
    {
        return $this->belongsTo(TruckCompany::class,'truck_company_id');
    }
    public function carrier()
    {
        return $this->belongsTo(Carrier::class,'carrier_id');

    }
    public function port()
    {
        return $this->belongsTo(Port::class,'port_id');

    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class,'dock_id');
    }
}