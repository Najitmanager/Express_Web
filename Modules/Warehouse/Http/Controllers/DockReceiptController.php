<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Modules\Warehouse\Entities\Dock;
use Modules\Warehouse\Entities\Vehicle;
use Modules\Warehouse\Http\DataTables\DockDataTable;
use Modules\Warehouse\Http\DataTables\LoadPlanDataTable;
use Modules\Warehouse\Http\Requests\Dock\StoreRequest;

class DockReceiptController extends Controller
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
    public function index(DockDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.docks'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(DockDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.docks.index', $share_data);

    }
    public function getIndex(DockDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.docks'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(DockDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.docks.ajax.index_ajax', $share_data);

    }
    public function getloadplans(LoadPlanDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.docks'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(LoadPlanDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.docks.ajax.load_plan_ajax', $share_data);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        //        $model = Dock::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.docks.create'/*, compact('model')*/);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        $data = \Arr::except($request->validated(), ['vehicles','save']);
        $dock = Dock::create($data+['branch_id'=>app('hook')->get('warehouse')->id,'created_by'=>auth()->id()]);
        if($request->vehicles){
            foreach ($request->vehicles as $key){
                $vehicle = Vehicle::find($key);
                $vehicle->dock_id = $dock->id;
                $vehicle->save();
            }
        }
        if ($request->save=='save'){
            return redirect()->back()->with(['message_alert' => __('cargo::messages.created')]);
        }
        return redirect()->route('docks.index')->with(['message_alert' => __('cargo::messages.created')]);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
//        $model = Dock::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.docks.show'/*, compact('model')*/);

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

    public function getVehicles($client_id,$port_id)
    {
        $vehicles = Vehicle::where(['client_id'=>$client_id,'port_id'=>$port_id])->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        $view = view('warehouse::'.$adminTheme.'.pages.docks.ajax.add-vehicle-index', compact('vehicles'))->render();
        return response()->json(['value' => 1, 'view' => $view ,'number'=>count($vehicles)]);
    }
    public function insertVehicles(Request $request)
    {
        $vehicles = Vehicle::whereIn('id',$request->vehicles)->get();
        $ids=$request->vehicles;
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        $view = view('warehouse::'.$adminTheme.'.pages.docks.ajax.get-vehicles-index', compact('vehicles','ids'))->render();
        return response()->json(['value' => 1, 'view' => $view ,'number'=>count($vehicles)]);
    }

}
