<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Model extends Eloquent
{
    use HasFactory;

    protected $fillable = ['make_id','slug','name'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\ModelFactory::new();
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

    public function make()
    {
        return $this->belongsTo(Make::class);
    }
}
