<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected  $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\WorkflowFactory::new();
    }
}
