<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Modules\Warehouse\Entities\Booking;
use Modules\Warehouse\Http\DataTables\BookingsDataTable;
use Modules\Warehouse\Http\Requests\Booking\StoreRequest;

class BookingController extends Controller
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
    public function index(BookingsDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('warehouse::view.bookings'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(BookingsDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('warehouse::'.$adminTheme.'.pages.bookings.index', $share_data);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('warehouse::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Booking::create($data);
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
                'name' => __('warehouse::view.bookings'),
                'path' => fr_route('bookings.index')
            ],
            [
                'name' => __('warehouse::view.edit_consignee'),
            ]
        ]);


        $booking = Booking::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        $table_id = 'bookings_table';
        $view = view('warehouse::'.$adminTheme.'.pages.bookings.ajax.booking_form_edit', ['model' => $booking  ,'table_id' => $table_id])->render();
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
        $booking = Booking::findOrFail($id);
        $booking->update($request->validated());
        return response()->json(['success'=>true]);
    }

    public function bookingClose($id)
    {
        $booking = Booking::findOrFai($id);
        $booking->update(['closed_on' => now()->format('Y-m-d')]);
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        Booking::destroy($id);
        return response()->json(['message' => __('cargo::messages.deleted')]);
    }
}
