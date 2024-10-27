@extends('warehouse::adminLte.layouts.master')

@section('pageTitle')
    {{ __('warehouse::view.edit_truck_company') }} - {{$model->company_name}}
@endsection


@section('content')

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        {{-- <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details"> --}}
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('warehouse::view.edit_truck_company') }}</h3>
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
                            <i class="fa-solid fa-truck"></i> {{ __('warehouse::view.truck_company_information') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session()->get('tab')) active @endif" id="custom-content-below-profile-tab" data-toggle="pill"
                           href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                           aria-selected="false">
                            <i class="fa-regular fa-folder-open"></i> {{ __('warehouse::view.files_attachments') }}
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">

                    <div class="tab-pane fade @if(!session()->get('tab')) show active @endif" id="custom-content-below-home" role="tabpanel"
                         aria-labelledby="custom-content-below-home-tab">
                        <form id="kt_account_profile_details_form" class="form"
                              action="{{ fr_route('truck_companies.update', ['id' => $model->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @include('warehouse::adminLte.pages.truck_companies.form', ['typeForm' => 'edit'])

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
                    <div class="tab-pane fade @if(session()->get('tab')) show active @endif" id="custom-content-below-profile" role="tabpanel"
                         aria-labelledby="custom-content-below-profile-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-3">
                                    <div class="card-header">


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form id="file-upload-form" action="{{ fr_route('truck_companies.upload_files', ['id' => $model->id]) }}" method="post" enctype="multipart/form-data">
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
                                                            data-action="{{ fr_route('truck_companies.media.destroy', [$model->id,$file->id]) }}"
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
        $('#upload-button').click(function () {
            // let files = $('#attachments').files;
            console.log($('#attachments').files)
            if (files.length === 0) {
                toastr.error('I do not think that word means what you think it means.', 'Inconceivable!')
            }
            let formData = new FormData();

            // Append all selected files to FormData
            for (let i = 0; i < files.length; i++) {
                formData.append('attachments[]', files[i]);
            }

            // Optional: Append the model ID if needed
            formData.append('model_id', '{{$model->id ?? null}}');

            // Send the files via AJAX
            {{--fetch('{{ route('your-upload-route') }}', {--}}
            {{--    method: 'POST',--}}
            {{--    body: formData,--}}
            {{--    headers: {--}}
            {{--        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value--}}
            {{--    }--}}
            {{--})--}}
            {{--    .then(response => response.json())--}}
            {{--    .then(data => {--}}
            {{--        if (data.success) {--}}
            {{--            alert('Files uploaded successfully!');--}}
            {{--            // Optionally, refresh or show uploaded files--}}
            {{--        } else {--}}
            {{--            alert('Error uploading files.');--}}
            {{--        }--}}
            {{--    })--}}
            {{--    .catch(error => {--}}
            {{--        console.error('Error:', error);--}}
            {{--        alert('An error occurred during the file upload.');--}}
            {{--    });--}}
        });

    </script>
@stop
