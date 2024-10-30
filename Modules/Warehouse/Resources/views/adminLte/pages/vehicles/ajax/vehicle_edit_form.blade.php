<form id="form_body" action="{{ fr_route('vehicles.store') }}" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            @include('warehouse::adminLte.pages.vehicles.form', ['typeForm' => 'create'])
        </div>
        <!--end::Card body-->

    </div>
    <div class="modal-footer justify-content-navbar">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('view.discard')</button>
        <button type="button" class="btn btn-primary" id="form_submit">@lang('view.create')</button>
    </div>
</form>