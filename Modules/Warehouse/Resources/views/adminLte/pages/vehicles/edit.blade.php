@extends('warehouse::adminLte.layouts.master')

@section('pageTitle')
    {{ __('warehouse::view.edit_customer') }} - {{$model->user->name}}
@endsection


@section('content')

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <i class="fa-solid fa-user"></i>
                <h3 class="fw-bolder m-0">{{ __('warehouse::view.edit_customer') }}</h3>
            </div>
            <!--end::Card title-->

        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div>
            <!--begin::Form-->

            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(!session()->get('tab')) active @endif" id="custom-content-below-home-tab" data-toggle="pill"
                           href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                           aria-selected="true">
                            <i class="fa-solid fa-address-book"></i> {{ __('warehouse::view.customer_information') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session()->get('tab') === 'files') active @endif" id="custom-content-below-profile-tab" data-toggle="pill"
                           href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                           aria-selected="false">
                            <i class="fa-regular fa-folder-open"></i> {{ __('warehouse::view.files_attachments') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(session()->get('tab') === 'price_history') active @endif" id="custom-content-below-price_history-tab" data-toggle="pill"
                           href="#custom-content-below-price_history" role="tab" aria-controls="custom-content-below-price_history"
                           aria-selected="false">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i> {{ __('warehouse::view.price_history') }}
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">

                    <div class="tab-pane fade @if(!session()->get('tab')) show active @endif" id="custom-content-below-home" role="tabpanel"
                         aria-labelledby="custom-content-below-home-tab">
                        <form id="kt_account_profile_details_form" class="form"
                              action="{{ fr_route('customers.update', ['id' => $model->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @include('warehouse::adminLte.pages.customers.form', ['typeForm' => 'edit'])

                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{ url()->previous() }}"
                                   class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>
                                <button type="submit" class="btn btn-success"
                                        id="kt_account_profile_details_submit">@lang('view.update')</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                    </div>
                    <div class="tab-pane fade @if(session()->get('tab') === 'files') show active @endif" id="custom-content-below-profile" role="tabpanel"
                         aria-labelledby="custom-content-below-profile-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-3">
                                    <div class="card-header">


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form id="file-upload-form" action="{{ fr_route('customers.upload_files', ['id' => $model->id]) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @if(isset($model))
                                                        <x-media-library-collection id="attachments" name="attachments"
                                                                                    :model="$model"

                                                                                    collection="attachments"
                                                                                    rules="mimes:pdf,jpg,jpeg,png,gif,bmp,svg,webp"/>
                                                    @else
                                                        <x-media-library-attachment id="attachments" multiple
                                                                                    name="attachments"
                                                                                    rules="mimes:pdf,jpg,jpeg,png,gif,bmp,svg,webp"/>
                                                    @endif

                                                    <button type="submit" class="btn btn-success m-2">
                                                        <i class="fa-solid fa-file-circle-plus"></i>
                                                        @if(count($model->getMedia('attachments')))
                                                        {{ __('warehouse::view.save_files') }}
                                                        @else
                                                        {{ __('warehouse::view.add_files') }}
                                                        @endif
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

                                            @foreach($model->getMedia('attachments') as $file)

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
                                                            data-action="{{ fr_route('customers.media.destroy', [$model->id,$file->id]) }}"
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
                    </div>

                    <div class="tab-pane fade @if(session()->get('tab') === 'price_history') show active @endif" id="custom-content-below-price_history" role="tabpanel"
                         aria-labelledby="custom-content-below-price_history-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form id="price-form" action="{{ fr_route('customers.price.store', ['customer_id' => $model->id]) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body border-top">
                                                        <!--begin::Input group --  price -->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('warehouse::view.price') }}</label>
                                                            <!--end::Label-->

                                                            <!--begin::Input group-->
                                                            <div class="col-lg-8 fv-row">
                                                                <div class="input-group mb-4">
                                                                    <input type="text" name="price" class="form-control form-control-lg @error('price') is-invalid @enderror"
                                                                           placeholder="{{ __('warehouse::view.price') }}"
                                                                           value="{{ old('price') }}"/>
                                                                    @error('price')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group --  as_of_date -->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('warehouse::view.as_of_date') }}</label>
                                                            <!--end::Label-->

                                                            <!--begin::Input group-->
                                                            <div class="col-lg-8 fv-row">
                                                                <div class="input-group mb-4">
                                                                    <input
                                                                        class="form-control form-control-lg @error('as_of_date') is-invalid @enderror"
                                                                        placeholder="{{ __('view.pick_date_range') }}"
                                                                        id="page_publish_immediately"
                                                                        value="{{old('as_of_date') != null ? date('Y-m-d', strtotime(old('as_of_date'))) . ' At ' . date('h:i A', strtotime(old('as_of_date'))) : ''}}"  >
                                                                    <input
                                                                        type="hidden"
                                                                        name="as_of_date"
                                                                        id="page_publish_immediately_value"
                                                                        value=""
                                                                    >
                                                                    <!--begin::Input group-->

                                                                    <!--end::Input group-->
                                                                    @error('as_of_date')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::Input group-->

                                                    </div>
                                                    <div class="card-footer d-flex justify-content-start py-6 px-9">
                                                        <button type="submit" class="btn btn-success m-2">
                                                            <i class="fa-solid fa-square-plus"></i>
                                                            {{ __('cargo::view.save') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table id="files" class="table table-head-fixed text-nowrap">
                                            <thead>
                                            <tr>
                                                <th >{{ __('warehouse::view.price') }}</th>
                                                <th >{{ __('view.as_of_date') }}</th>
                                                <th >{{ __('view.action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody id="price_table_body">

                                            @foreach($model->pricingHistory as $price)

                                                <tr>
                                                    <td>
                                                        {{ $price->price }}
                                                    </td>
                                                    <td >{{ $price->as_of_date }}</td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            data-action="{{ fr_route('customers.price.destroy', [$model->id,$price->id]) }}"
                                                            data-callback="delete-row"
                                                            data-table-id="files"
                                                            data-model-name="{{ __('warehouse::view.price') }}"
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
                    </div>

                </div>

            </div>
            <!--end::Card body-->


            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#price-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = new FormData(this); // Gather all form data

                $.ajax({
                    url: $(this).attr('action'), // Use the form's action URL
                    type: $(this).attr('method'), // Use the form's method (POST in this case)
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Optional: you can show a loading spinner here
                    },
                    success: function(response) {
                        // Handle success (server response)
                        alert('Form submitted successfully!');
                        $('#price_table_body').append(response)

                        // You can also reload the page or redirect
                        // window.location.href = '/some-page';
                    },
                    error: function(xhr) {
                        // Handle error
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            // Loop through the errors and display them
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    var errorElement = $('[name="' + key + '"]').next('.invalid-feedback');
                                    errorElement.html(errors[key][0]).show();
                                }
                            }
                        }
                    }
                });
            });
        });

    </script>
@stop
@push('js-component')
    <script>
        // publish date
        var inputDate = $(`#page_publish_immediately`),
            inputDateValue = $('#page_publish_immediately_value'),
            start;
        // Trigger date picker for created at
        inputDate.daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            autoUpdateInput: false,
            minYear: parseInt(moment().format('YYYY')) - 10,
            maxYear: parseInt(moment().format('YYYY')) + 10,
            timePicker: true,
            startDate: moment().startOf('minute'),
            // timePickerSeconds: false,
            locale: {
                format: "DD/MM/YYYY",
                cancelLabel: "{{ __('view.cancel') }}",
                applyLabel: "{{ __('view.apply') }}",
                "fromLabel": "{{ __('view.from') }}",
                "toLabel": "{{ __('view.to') }}",
                "customRangeLabel": "{{ __('datepicker.custom_range') }}",
                "weekLabel": "{{ __('datepicker.week_label') }}",
                "daysOfWeek": [
                    "{{ __('datepicker.days_of_week.sunday') }}",
                    "{{ __('datepicker.days_of_week.monday') }}",
                    "{{ __('datepicker.days_of_week.tuesday') }}",
                    "{{ __('datepicker.days_of_week.wednesday') }}",
                    "{{ __('datepicker.days_of_week.thursday') }}",
                    "{{ __('datepicker.days_of_week.friday') }}",
                    "{{ __('datepicker.days_of_week.saturday') }}",
                ],
                "monthNames": [
                    "{{ __('datepicker.month_names.january') }}",
                    "{{ __('datepicker.month_names.february') }}",
                    "{{ __('datepicker.month_names.march') }}",
                    "{{ __('datepicker.month_names.april') }}",
                    "{{ __('datepicker.month_names.may') }}",
                    "{{ __('datepicker.month_names.june') }}",
                    "{{ __('datepicker.month_names.july') }}",
                    "{{ __('datepicker.month_names.august') }}",
                    "{{ __('datepicker.month_names.september') }}",
                    "{{ __('datepicker.month_names.october') }}",
                    "{{ __('datepicker.month_names.november') }}",
                    "{{ __('datepicker.month_names.december') }}",
                ],
            }
        }, cb);
        // call back after choose date
        function cb(start) {
            var apiDate = start ? start.format("YYYY-MM-DD H:m") : '';
            var inputShowDate = start ? (start.format("YYYY-MM-DD") + ' At ' + start.format("h:m A")) : '';
            if (start) {
                inputDate.val(inputShowDate);
                inputDateValue.val(apiDate);
            }
        }
        cb(start);
        // end publish date
    </script>
@endpush
