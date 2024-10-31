<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Entities\Dock;
use Modules\Warehouse\Http\Requests\Api\ContainerPhotosRequest;
use Modules\Warehouse\Http\Requests\Api\VehicleSearchRequest;
use Modules\Warehouse\Transformers\Api\DockResource;

class DockController extends Controller
{
    public function index(){
        $docks = Dock::where('type', Dock::DOCK)->get();
        return (DockResource::collection($docks))->additional(['status' => 'success', 'message' => '']);

    }
    public function show($id)
    {
        $dock = Dock::findOrFail($id);
        return (new DockResource($dock))->additional(['status' => 'success', 'message' => '']);
    }
    public function search(VehicleSearchRequest $request)
    {
        $keyword = $request->get('keyword');
        $docks = Dock::where('container_no', 'LIKE', "%$keyword%")
            ->orWhere('document_no', 'LIKE', "%$keyword%")
            ->get();
        return (DockResource::collection($docks))->additional(['status' => 'success', 'message' => '']);

    }

    public function setLoading($id,Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);
        $dock = Dock::findOrFail($id);
        $dock->update(['loading_date' => $request->date]);
        return (new DockResource($dock))->additional(['status' => 'success', 'message' => 'Update Successfully.']);
    }

    public function setPhotos($id,ContainerPhotosRequest $request)
    {
        $dock = Dock::findOrFail($id);
        foreach ($request->photos as $photo) {
            $dock->addMedia($photo)->toMediaCollection($request->type);
        }
        return (new DockResource($dock))->additional(['status' => 'success', 'message' => 'Update Successfully.']);
    }

}
