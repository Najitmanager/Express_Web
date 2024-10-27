<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Client;
use Twilio\Rest\Pricing;

class PricingHistory extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','price'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\PricingHistoryFactory::new();
    }

    /* ======================> Relations <===========================*/
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
}
