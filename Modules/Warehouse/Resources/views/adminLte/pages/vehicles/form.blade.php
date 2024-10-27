@csrf
<div class="card card-secondary" style="border: 1px solid #eff2f5">
    <div class="card-header">
        <h3 class="card-title" style="color: #ffffff;">{{ __('warehouse::view.login_credentials') }}</h3>
    </div>

    <div class="card-body" style="background-color: #f6f6f6">
        <div class="row mb-6">
            <!--begin::Input group -- VIN -->
            <div class="col-lg-6 fv-row">
                <!--begin::Label-->
                <label class="col-form-label fw-bold fs-6 ">{{ __('warehouse::view.vin') }}</label>
                <!--end::Label-->
                <div class="input-group mb-4">
                    <input type="text" class="form-control rounded-0 @error('vin') is-invalid @enderror"
                           placeholder="{{ __('warehouse::view.vin') }}"
                           value="{{ old('vin', isset($model) ? $model->vin : '') }}">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-primary btn-flat">{{ __('warehouse::view.pull_vehicle_info') }}</button>
                    </span>
                    @error('vin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group -- Type -->
            <div class="col-lg-6 fv-row">
                <!--begin::Label-->
                <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.type') }}</label>
                <!--end::Label-->
                <div class="input-group mb-4">
                    <select
                        class="form-control  @error('type_id') is-invalid @enderror"
                        name="type_id"
                        data-control="select2"
                        data-placeholder="{{ __('warehouse::view.table.choose_type') }}"
                        data-allow-clear="true"
                    >
                        <option></option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                {{ old('type_id') == $type->id ? 'selected' : '' }}
                            @if($typeForm == 'edit')
                                {{ $model->type_id == $type->id ? 'selected' : '' }}
                                @endif
                            >{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group -- Make -->
            <div class="col-lg-4 fv-row">
                <!--begin::Label-->
                <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.make') }}</label>
                <!--end::Label-->
                <div class="input-group mb-4">
                    <select
                        class="form-control  @error('make_id') is-invalid @enderror"
                        name="make_id"
                        id="make"
                        data-control="select2"
                        data-placeholder="{{ __('warehouse::view.table.choose_make') }}"
                        data-allow-clear="true">
                        <option></option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                {{ old('make_id') == $type->id ? 'selected' : '' }}
                            @if($typeForm == 'edit')
                                {{ $model->make_id == $type->id ? 'selected' : '' }}
                                @endif
                            >{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('make_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group -- Make -->
            <div class="col-lg-4 fv-row">
                <!--begin::Label-->
                <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.make') }}</label>
                <!--end::Label-->
                <div class="input-group mb-4">
                    <select
                        class="form-control  @error('make_id') is-invalid @enderror"
                        name="make_id"
                        id="make"
                        data-control="select2"
                        data-placeholder="{{ __('warehouse::view.table.choose_make') }}"
                        data-allow-clear="true">
                        <option></option>
                        @foreach($makes as $make)
                            <option value="{{ $make->id }}"
                                {{ old('make_id') == $make->id ? 'selected' : '' }}
                            @if($makeForm == 'edit')
                                {{ $model->make_id == $make->id ? 'selected' : '' }}
                                @endif
                            >{{ $make->name }}</option>
                        @endforeach
                    </select>
                    @error('make_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group -- Model -->
            <div class="col-lg-4 fv-row">
                <!--begin::Label-->
                <label class="col-form-label fw-bold fs-6">{{ __('cargo::view.table.model') }}</label>
                <!--end::Label-->
                <div class="input-group mb-4">
                    <select
                        class="form-control  @error('model_id') is-invalid @enderror"
                        name="model_id"
                        id="model"
                        data-control="select2"
                        data-placeholder="{{ __('warehouse::view.table.choose_make') }}"
                        data-allow-clear="true">
                        <option></option>
                        @foreach($makes as $make)
                            <option value="{{ $make->id }}"
                                {{ old('model_id') == $make->id ? 'selected' : '' }}
                            @if($makeForm == 'edit')
                                {{ $model->model_id == $make->id ? 'selected' : '' }}
                                @endif
                            >{{ $make->name }}</option>
                        @endforeach
                    </select>
                    @error('model_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

        </div>
    </div>
</div>
