<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Modules\Warehouse\Entities\Carrier;
use Modules\Warehouse\Http\DataTables\CarriersDataTable;
use Modules\Warehouse\Http\Requests\Carrier\StoreRequest;

class CarrierController extends Controller
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
    public function index(CarriersDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.carriers'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(CarriersDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.carriers.index', $share_data);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.carriers'),
                'path' => fr_route('carriers.index')
            ],
            [
                'name' => __('warehouse::view.create_new_carrier'),
            ]
        ]);


        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.carriers.create');

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Carrier::create($data);
        return response()->json(['success'=>true]);
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
                'name' => __('warehouse::view.carriers'),
                'path' => fr_route('carriers.index')
            ],
            [
                'name' => __('warehouse::view.edit_carrier')
            ]
        ]);

        $carrier = Carrier::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.carriers.edit')->with(['model' => $carrier ]);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreRequest $request, $id)
    {
        $carrier = Carrier::findOrFail($id);
        $carrier->update($request->validated());
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved')]);
    }
    public function update_active(Request $request)
    {
        $carrier = Carrier::findOrFail($request->id);
        $carrier->active = $request->active;
        $carrier->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $carrier = Carrier::findOrFail($id);
        Carrier::destroy($id);
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
        Carrier::destroy($ids);
        return response()->json(['message' => __('currency::messages.multi_deleted')]);
    }
}
