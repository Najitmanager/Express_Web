<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['booking_no','booking_date','closed_on'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\BookingFactory::new();
    }

    /* ===================> Attributes <=========================== */
    public function getNameIconAttribute()
    {
        if (is_null($this->closed_on)){
            return '<i class="fa-solid fa-unlock"></i>'.$this->booking_no;
        }else{
            return '<i class="fa-solid fa-lock"></i>'.$this->booking_no;
        }

    }
}
