<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Warehouse\Entities\Vehicle;
use Modules\Warehouse\Http\Requests\Api\VehiclePhotosRequest;
use Modules\Warehouse\Http\Requests\Api\VehicleSearchRequest;
use Modules\Warehouse\Http\Requests\Api\VehicleStoreRequest;
use Modules\Warehouse\Transformers\Api\VehicleResource;

class VehicleController extends Controller
{
    public function index($status, Request $request)
    {
        if (!in_array($status, ['new', 'in'])) {
            return response()->json(['status' => 'fail', 'data' => null, 'message' => 'Invalid Status'], 403);
        }
        switch ($status) {
            case 'new':
                $vehicles = Vehicle::where('status', 0)->get();
                break;
            case 'in':
                $vehicles = Vehicle::where('status', 1)->get();
                break;
        }

        return (VehicleResource::collection($vehicles))->additional(['status' => 'success', 'message' => '']);
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return (new VehicleResource($vehicle))->additional(['status' => 'success', 'message' => '']);
    }

    public function pullInfo($vin)
    {
        $data = decodeVin($vin);

        return response()->json(['status' => 'success', 'data' => $data, 'message' => '']);


    }

    public function store(VehicleStoreRequest $request)
    {
        $vehicle = Vehicle::create(\Arr::except($request->validated(), ['make_id']) + ['client_id' => 1]);

        return (new VehicleResource($vehicle))->additional(['status' => 'success', 'message' => 'Created Successfully.']);
    }

    public function search(VehicleSearchRequest $request)
    {
        $keyword = $request->get('keyword');
        $vehicles = Vehicle::where('vin', 'LIKE', "%$keyword%")
            ->orWhereHas('model', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%")
                    ->orWhereHas('make', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', "%$keyword%");
                    });
            })
            ->orWhere('year', 'LIKE', "%$keyword%")
            ->get();
        return (VehicleResource::collection($vehicles))->additional(['status' => 'success', 'message' => '']);

    }

    public function setArrival($id,Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update(['status' => 1]);
        $vehicle->workflow()->updateOrCreate(['arrival_date'=>$request->date]);
        return (new VehicleResource($vehicle))->additional(['status' => 'success', 'message' => 'Update Successfully.']);
    }

    public function setPhotos($id,VehiclePhotosRequest $request)
    {
        $vehicle = Vehicle::findOrFail($id);
        foreach ($request->photos as $photo) {
            $vehicle->addMedia($photo)->toMediaCollection($request->type);
        }
        return (new VehicleResource($vehicle))->additional(['status' => 'success', 'message' => 'Update Successfully.']);
    }
}
