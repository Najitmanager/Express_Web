<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    const TITLE_STATUS=[
        0=>'unset',
        1=>'No Title',
        2=>'Have Title',
        11=>'BOS Parts only no title',
        12=>'lien paper',
        13=>'Lien hold',
        14=>'WA BOS',
        15=>'MV 907',
        16=>'Pending GA',
        17=>'Normal',
        18=>'Pending all states',
        19=>'NY Title',
        20=>'VIRGINIA Title',
        100=>'WITH THE DRIVER',
        101=>'AUCTION ISSUE',
        102=>'WAREHOUSE ISSUE',
        103=>'PRIVATE CAMBODIA CARS',
        104=>'PRIVATE NEJOUM CUSTOMER',
        105=>'Silverlake Account',
        106=>'Mailed To Warehouse',
        107=>'With the Auction / Request to Mail'
    ];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\WorkflowFactory::new();
    }

    public function getTitleStatusNameAttribute()
    {
        return self::TITLE_STATUS[$this->title_status];
    }
}
