@csrf



<div class="row mb-6">
    <!--begin::Input group -- Booking No -->

    <div class="col-lg-6 fv-row">
        <div class="row">
            <div class="col-md-3">
                <!--begin::Label-->
                <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.booking_no') }}</label>
            </div>
            <div class="col-md-9">
                <!--end::Label-->
                <div class="input-group mb-4">
                    <input type="text" name="booking_no"
                        class="form-control form-control-lg @error('booking_no') is-invalid @enderror"
                        placeholder="{{ __('warehouse::view.booking_no') }}"
                        value="{{ old('booking_no', isset($model) ? $model->booking_no : '') }}" />
                    @error('booking_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>


    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Booking Date -->

    <div class="col-lg-6 fv-row">
        <div class="row">
            <div class="col-md-3">
                <!--begin::Label-->
                <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.booking_date') }}</label>
            </div>
            <div class="col-md-9">
                <!--end::Label-->
                <div class="input-group mb-4">
                    <input type="date" name="booking_date"
                        class="form-control form-control-lg @error('booking_date') is-invalid @enderror"
                        placeholder="{{ __('warehouse::view.booking_date') }}"
                        value="{{ old('booking_date', isset($model) ? $model->booking_date : date('Y-m-d')) }}" />
                    @error('booking_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Booking No -->

    @if ($typeForm == 'edit')
        <div class="col-lg-6 fv-row">
            <div class="row">
                <div class="col-md-3">
                    <!--begin::Label-->
                    <label class="col-form-label fw-bold fs-6 ">{{ __('warehouse::view.containers / LP') }}:</label>
                </div>
                <div class="col-md-9">
                    <!--end::Label-->
                    <div class="input-group mb-4">
                        <input type="text" disabled class="form-control form-control-lg " value=" 1 / 0" />
                    </div>
                </div>
            </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group  -->
        <div class="col-lg-6 fv-row">
            <div class="row">
                <div class="col-md-3">
                    <!--begin::Label-->
                    <label class="col-form-label fw-bold fs-6">{{ __('view.created_at') }}</label>
                </div>
                <div class="col-md-9">
                    <!--end::Label-->
                    <div class="input-group mb-4">
                        <input type="text" disabled class="form-control form-control-lg"
                            value="{{ $model->created_at->format('Y-m-d') }}" />
                    </div>
                </div>
            </div>


        </div>
        <!--end::Input group-->
        <!--begin::Input group  -->
        <div class="col-lg-6">
            <div class="row">
                <div class="col-md-3">
                    <!--begin::Label-->
                    <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.Is Closed') }}?</label>
                    <!--end::Label-->
                </div>
                <div class="col-md-9 d-flex flex-row justify-content-start align-items-center">
                    <!--begin::Input group-->
                    <span class="mr-3">
                        <i class="fa-solid fa-unlock-keyhole text-success"></i>
                    </span>
                    <a href="#" class="btn btn-custom-save rounded-0 d-inline-block w-100" id="closed-the-booking"
                        data-href="{{ fr_route('bookings.close', $model->id) }}">
                        {{ __('warehouse::view.close_the_booking') }}

                    </a>
                </div>
            </div>
        </div>
        <!--end::Input group-->
    @endif
</div>
<div class="row">
    <div class="col-12">


        <div class="card  vehicle-detail-card  mb-0 ">

            <div class="vehicle-card-header">
                <span class="custom-title text-light">
                    {{ __('warehouse::view.Vehicle Info') }}
                </span>

                <button class="btn btn-light btn-sm px-4 rounded-0">
                    <i class="fa-solid fa-plus text-success"></i>
                    {{ __('warehouse::view.add_booking_files') }}
                </button>
            </div>

            <div class="card-body p-0">
                <table id="files" class="table table-hover vehicle-page-tables mt-0">
                    <thead>
                        <tr>
                            <th>{{ __('warehouse::view.table.file_name') }}</th>
                            <th>{{ __('view.created_at') }}</th>
                            <th>{{ __('view.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ([] as $file)
                            <tr>
                                <td class="btn btn-link">
                                    <a href="{{ $file->getFullUrl() }}" download>
                                        <i class="fa-solid fa-file-arrow-down"></i> {{ $file->name }}
                                    </a>
                                </td>
                                <td>{{ $file->created_at }}</td>
                                <td>
                                    <button type="button"
                                        data-action="{{ fr_route('bookings.media.destroy', [$model->id, $file->id]) }}"
                                        data-callback="reload-page" data-table-id="files"
                                        data-model-name="{{ __('warehouse::view.table.file') }}" data-time-alert="1100"
                                        class="delete-row btn btn-sm btn-danger btn-action-table btn-custom"
                                        data-toggle="tooltip" title="{{ __('view.delete') }}"
                                        data-modal-message="@lang('view.modal_message_delete')" data-modal-action="@lang('view.delete')">
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
