<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Entities\Color;
use Modules\Warehouse\Entities\Make;
use Modules\Warehouse\Entities\Model;
use Modules\Warehouse\Entities\Type;
use Modules\Warehouse\Transformers\Api\BranchResource;
use Modules\Warehouse\Transformers\Api\GeneralResource;
use Modules\Warehouse\Transformers\Api\MakeResource;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function branches(){
        $user = auth('api')->user();
        return (BranchResource::collection($user->branches))->additional(['status' => 'success','message'=> '']);
    }
    public function types(){
        $types = Type::all();
        return (GeneralResource::collection($types))->additional(['status' => 'success','message'=> '']);
    }

    public function makes()
    {
        $makes = Make::all();
        return (MakeResource::collection($makes))->additional(['status' => 'success','message'=> '']);
    }
    public function models($make_id)
    {
        $models = Model::where('make_id',$make_id)->get();
        return (GeneralResource::collection($models))->additional(['status' => 'success','message'=> '']);
    }
    public function colors()
    {
        $colors = Color::all();
        return (GeneralResource::collection($colors))->additional(['status' => 'success','message'=> '']);
    }
}
