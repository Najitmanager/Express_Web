<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Modules\Cargo\Entities\Country;
use Modules\Warehouse\Entities\Port;
use Modules\Warehouse\Http\DataTables\PortsDataTable;
use Modules\Warehouse\Http\Requests\Port\StoreRequest;

class PortController extends Controller
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
    public function index(PortsDataTable $portsDataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.ports'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(PortsDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $portsDataTable->render('warehouse::'.$adminTheme.'.pages.ports.index', $share_data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.ports'),
                'path' => fr_route('ports.index')
            ],
            [
                'name' => __('warehouse::view.create_new_port')
            ]
        ]);

        $countries = Country::all();

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.ports.create')->with(['countries' => $countries ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        Port::create($data);
        return redirect()->route('ports.index')->with(['message_alert' => __('cargo::messages.created')]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return error(404);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.ports'),
                'path' => fr_route('ports.index')
            ],
            [
                'name' => __('warehouse::view.edit_port')
            ]
        ]);

        $countries = Country::all();
        $port = Port::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.ports.edit')->with(['model' => $port ,  'countries' => $countries ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreRequest $request, $id)
    {
        $port = Port::findOrFail($id);
        $port->update($request->validated());

        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved')]);

    }

    public function update_active(Request $request)
    {
        $port = Port::findOrFail($request->id);
        $port->active = $request->active;
        $port->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $port = Port::findOrFail($id);
        Port::destroy($id);
        return response()->json(['message' => __('cargo::messages.deleted')]);

    }
    /**
     * Remove multi port from database.
     * @param Request $request
     * @return Renderable
     */
    public function multiDestroy(Request $request)
    {
        $ids = $request->ids;
        Port::destroy($ids);
        return response()->json(['message' => __('currency::messages.multi_deleted')]);
    }


}
