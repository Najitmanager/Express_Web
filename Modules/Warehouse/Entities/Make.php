<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;



class Make extends Model
{
    use HasFactory;

    protected $fillable = ['slug','name'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\MakeFactory::new();
    }

    /**
     * Observer locale.
     */

    protected static function boot()
    {
        parent::boot();
        static::created(function ($season) {
            $season->update([
                'slug' => Str::slug($season->name, ''),
            ]);
        });
    }

    /*==================> Relations <===========================*/
    public function models()
    {
        return $this->hasMany(\Modules\Warehouse\Entities\Model::class);
    }

}
