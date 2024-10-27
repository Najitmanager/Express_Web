<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserBranch extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'branch_id'];

    protected static function newFactory()
    {
        return \Modules\Warehouse\Database\factories\UserBranchFactory::new();
    }

}
