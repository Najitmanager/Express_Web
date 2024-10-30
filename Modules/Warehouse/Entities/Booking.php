<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Booking extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['booking_no','booking_date','closed_on'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }
    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\BookingFactory::new();
    }

    /* ===================> Attributes <=========================== */
    public function getNameIconAttribute()
    {
        if (is_null($this->closed_on)){
            return '<i class="fa-solid fa-unlock-keyhole text-success"></i> '.$this->booking_no;
        }else{
            return '<i class="fa-solid fa-lock text-success"></i> '.$this->booking_no;
        }

    }
}
