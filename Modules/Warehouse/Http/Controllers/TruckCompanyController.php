<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Modules\Cargo\Entities\Country;
use Modules\Warehouse\Entities\TruckCompany;
use Modules\Warehouse\Http\DataTables\TruckCompanyDataTable;
use Modules\Warehouse\Http\Requests\TruckCompany\StoreRequest;
use Modules\Warehouse\Http\Requests\TruckCompany\UploadFilesRequest;

class TruckCompanyController extends Controller
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
    public function index(TruckCompanyDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.truck_companies'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(TruckCompanyDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.truck_companies.index', $share_data);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.truck_companies'),
                'path' => fr_route('truck_companies.index')
            ],
            [
                'name' => __('warehouse::view.create_new_truck_company'),
            ]
        ]);

        $countries = Country::all();

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.truck_companies.create')->with(['countries' => $countries ]);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        TruckCompany::create($data);
        return redirect()->route('truck_companies.index')->with(['message_alert' => __('cargo::messages.created')]);


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
//        breadcrumb([
//            [
//                'name' => __('users::view.truck_companies'),
//                'path' => fr_route('truck_companies.index')
//            ],
//            [
//                'name' => __('view.profile_details')
//            ],
//        ]);
//        $truck_company = TruckCompany::findOrFail($id);
//        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.truck_companies.show')->with(['model' => $truck_company]);

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
                'name' => __('warehouse::view.truck_companies'),
                'path' => fr_route('truck_companies.index')
            ],
            [
                'name' => __('warehouse::view.edit_truck_company'),
            ]
        ]);

        $countries = Country::all();
        $truck_company = TruckCompany::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.truck_companies.edit')->with(['model' => $truck_company , 'countries' => $countries ]);


    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreRequest $request, $id)
    {
        $truck_company = TruckCompany::findOrFail($id);
        $truck_company->update($request->validated());
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved')]);

    }

    public function update_active(Request $request)
    {
        $consignee = TruckCompany::findOrFail($request->id);
        $consignee->active = $request->active;
        $consignee->save();
        return 1;
    }

    public function upload_files(UploadFilesRequest $request, $id){
        $truckCompany = TruckCompany::findOrFail($id);
        $truckCompany->syncFromMediaLibraryRequest($request->attachments)->toMediaCollection('attachments');
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved'),'tab'=>'files']);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $consignee = TruckCompany::findOrFail($id);
        TruckCompany::destroy($id);
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
        TruckCompany::destroy($ids);
        return response()->json(['message' => __('currency::messages.multi_deleted')]);
    }

    public function destroyMedia($truck_company_id,$id){
        $truckCompany = TruckCompany::findOrFail($truck_company_id);
        $truckCompany->deleteMedia($id);
        return response()->json(['message' => __('cargo::messages.deleted')]);

    }

}
