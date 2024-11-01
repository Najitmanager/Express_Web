<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\Branch;

class SettingController extends Controller
{
    public function warehouseSwitch($id){
        $branch = Branch::findOrFail($id);
        session(['warehouse'=>$branch]);
        app('hook')->set('warehouse', $branch, 'object');
        return redirect()->back();
    }
}
