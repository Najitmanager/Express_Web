@csrf



<div class="row mb-6">
    <!--begin::Input group -- Booking No -->

    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.booking_no') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="booking_no"
                   class="form-control form-control-lg @error('booking_no') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.booking_no') }}"
                   value="{{ old('booking_no', isset($model) ? $model->booking_no : '') }}"/>
            @error('booking_no')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Booking Date -->

    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.booking_date') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="date" name="booking_date"
                   class="form-control form-control-lg @error('booking_date') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.booking_date') }}"
                   value="{{ old('booking_date', isset($model) ? $model->booking_date : date('Y-m-d')) }}"/>
            @error('booking_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Booking No -->

    @if($typeForm=='edit')


    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 ">{{ __('warehouse::view.containers / LP') }}:</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" disabled class="form-control form-control-lg " value=" 1 / 0"/>
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group  -->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('view.created_at') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" disabled class="form-control form-control-lg" value="{{ $model->created_at->format('Y-m-d') }}"/>

        </div>
    </div>
    <!--end::Input group-->
        <!--begin::Input group  -->
        <div class="col-lg-6 row">
            <!--begin::Label-->
            <label
                class="col-lg-3 col-form-label  fw-bold fs-6">{{ __('warehouse::view.Is Closed') }}?</label>
            <!--end::Label-->

            <!--begin::Input group-->
            <div class="col-lg-3 fv-row">
{{--                <span class="input-group mr-1">--}}
{{--                    <i class="fa-solid fa-unlock-keyhole text-success"></i>--}}
{{--                </span>--}}
                <div class="input-group">
                    <button type="button" class="btn btn-primary ">
                        {{ __('warehouse::view.close_the_booking') }}

                    </button>
                </div>
            </div>
        </div>
    <!--end::Input group-->
    @endif
</div>
<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-header">


                <div class="col-md-12">
                    <div class="form-group">
                        <form id="file-upload-form" action="#" method="post" enctype="multipart/form-data">
                            @csrf

                            <button type="submit" class="btn btn-success m-2">
                                <i class="fa-solid fa-file-circle-plus"></i>

                                    {{ __('warehouse::view.add_booking_files') }}

                            </button>
                        </form>
                    </div>
                </div>


            </div>

            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table id="files" class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th >{{ __('warehouse::view.table.file_name') }}</th>
                        <th >{{ __('view.created_at') }}</th>
                        <th >{{ __('view.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach([] as $file)

                        <tr>
                            <td class="btn btn-link">
                                <a href="{{ $file->getFullUrl() }}" download>
                                    <i class="fa-solid fa-file-arrow-down"></i> {{ $file->name }}
                                </a>
                            </td>
                            <td >{{ $file->created_at }}</td>
                            <td>
                                <button
                                    type="button"
                                    data-action="{{ fr_route('bookings.media.destroy', [$model->id,$file->id]) }}"
                                    data-callback="reload-page"
                                    data-table-id="files"
                                    data-model-name="{{ __('warehouse::view.table.file') }}"
                                    data-time-alert="1100"
                                    class="delete-row btn btn-sm btn-danger btn-action-table btn-custom"
                                    data-toggle="tooltip" title="{{ __('view.delete') }}"
                                    data-modal-message="@lang('view.modal_message_delete')"
                                    data-modal-action="@lang('view.delete')"
                                >
                                    <i class="fas fa-trash fa-fw"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>


