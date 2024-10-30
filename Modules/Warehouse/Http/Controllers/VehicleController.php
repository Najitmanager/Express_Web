<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Modules\Warehouse\Entities\Color;
use Modules\Warehouse\Entities\Make;
use Modules\Warehouse\Entities\Type;
use Modules\Warehouse\Entities\Vehicle;
use Modules\Warehouse\Http\DataTables\VehicleDataTable;
use Modules\Warehouse\Http\Requests\Vehicle\StoreRequest;

class VehicleController extends Controller
{
    private $aclRepo;


    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
//        $this->middleware('can:view-users')->only('index');
//        $this->middleware('user_role:1|0|3|4|5')->only('show');
//        $this->middleware('can:create-users')->only('create', 'store');
//        $this->middleware('user_role:1|0|3|4|5')->only('edit', 'update');
//        $this->middleware('can:delete-users')->only('delete', 'multiDestroy');
//        $this->middleware('isAdmin')->only('assignPermissionToUserView', 'assignPermissionToUser');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(VehicleDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.vehicles'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(VehicleDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.vehicles.index', $share_data);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.vehicles'),
                'path' => fr_route('vehicles.index')
            ],
            [
                'name' => __('warehouse::view.create_new_vehicle'),
            ]
        ]);

        $types = Type::all();
        $makes = Make::all();
        $colors = Color::all();

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.vehicles.create')->with(['types' => $types ,'makes' => $makes , 'colors' => $colors]);

    }

    public function getModels($id)
    {
        $make = Make::findOrFail($id);
        $models = $make->models()->select('id', 'name')->get(); // Select only id and name fields for efficiency

        return response()->json([
            'models' => $models
        ]);
    }
    public function pullInfo($vin)
    {
        $data = decodeVin($vin);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        $type_view = view('warehouse::'.$adminTheme.'.pages.vehicles.ajax.vehicle_types', $data)->render();
        $vehicle_view = view('warehouse::'.$adminTheme.'.pages.vehicles.ajax.vehicle_info', $data)->render();
        return response()->json(['value' => 1, 'type_view' => $type_view , 'vehicle_view' => $vehicle_view]);


    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        $vehicle = Vehicle::create(\Arr::except($request->validated(), ['make_id'])+['branch_id'=>app('hook')->get('warehouse')->id]);
        return response()->json(['success'=>true]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.vehicles.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('warehouse::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
