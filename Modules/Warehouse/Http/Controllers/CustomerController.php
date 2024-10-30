<?php

namespace Modules\Warehouse\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Country;
use Modules\Warehouse\Http\DataTables\CustomersDataTable;
use Modules\Warehouse\Http\Requests\Customer\PriceRequest;
use Modules\Warehouse\Http\Requests\Customer\StoreRequest;
use Modules\Warehouse\Http\Requests\TruckCompany\UploadFilesRequest;

class CustomerController extends Controller
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
    public function index(CustomersDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.customers'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(CustomersDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
      
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.customers.index', $share_data);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.customers'),
                'path' => fr_route('customers.index')
            ],
            [
                'name' => __('warehouse::view.create_new_customer'),
            ]
        ]);

        $countries = Country::all();

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('warehouse::'.$adminTheme.'.pages.customers.create')->with(['countries' => $countries ]);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['company_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $data = \Arr::except($data, ['company_name','password']);

        $user->clientInfo()->create($data);

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
                'name' => __('warehouse::view.customers'),
                'path' => fr_route('customers.index')
            ],
            [
                'name' => __('warehouse::view.edit_customer'),
            ]
        ]);

        $countries = Country::all();
        $client = user::findOrFail($id)->clientInfo;
        dd($client);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        $table_id = 'clients';
        $view = view('warehouse::'.$adminTheme.'.pages.customers.ajax.customer_form_edit', ['model' => $client , 'countries' => $countries ,'table_id' => $table_id])->render();
        return response()->json(['value' => 1, 'view' => $view ]);  

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $data = $request->validated();
        $dataFormatted = \Arr::except($data, ['company_name','password']);
        $client->update($dataFormatted);
        if ($request->has('company_name')) {
            $client->user->update(['name' => $data['company_name']]);
        }
        if ($request->has('email')) {
            $client->user->update(['email' => $data['email']]);
        }
        if ($request->has('password')) {
            $client->user->update(['password' =>  bcrypt($data['password'])]);
        }
        return redirect()->route('customers.index')->with(['message_alert' => __('cargo::messages.saved')]);
    }

    public function update_active(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->active = $request->active;
        $user->save();
        return 1;
    }
    public function upload_files(UploadFilesRequest $request, $id){
        $client = Client::findOrFail($id);
        $client->syncFromMediaLibraryRequest($request->attachments)->toMediaCollection('attachments');
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved'),'tab'=>'files']);

    }

    public function priceStore(PriceRequest $request,$client_id)
    {
        $client = Client::findOrFail($client_id);
        $price = $client->pricingHistory()->create($request->validated());
//        $adminTheme = env('ADMIN_THEME', 'adminLte');
//        return view('warehouse::'.$adminTheme.'.pages.customers.ajax.price_row')->with([ 'price' => $price ]);
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved'),'tab'=>'price_history']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
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
        Client::destroy($ids);
        return response()->json(['message' => __('currency::messages.multi_deleted')]);
    }

    public function destroyMedia($client_id,$id){
        $truckCompany = Client::findOrFail($client_id);
        $truckCompany->deleteMedia($id);
        return response()->json(['message' => __('cargo::messages.deleted')]);

    }
}
