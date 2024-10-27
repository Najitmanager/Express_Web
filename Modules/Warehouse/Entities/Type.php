<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\TypeFactory::new();
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($season) {
            $season->update([
                'slug' => Str::slug($season->name, ''),
            ]);
        });
    }
}
