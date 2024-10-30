@csrf


<!--begin::Input group --  name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label
        class="col-lg-2 col-form-label required fw-bold fs-6">{{ __('warehouse::view.carrier_name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-10 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.carrier_name') }}"
                   value="{{ old('name', isset($model) ? $model->name : '') }}"/>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->

<!--begin::Input group --  Tracking URL -->
<div class="row mb-6">
    <!--begin::Label-->
    <label
        class="col-lg-2 col-form-label required fw-bold fs-6">{{ __('warehouse::view.tracking_url') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-10 fv-row">
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
            </div>
            <input type="text" name="tracking_url" class="form-control form-control-lg @error('tracking_url') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.tracking_url') }}"
                   value="{{ old('tracking_url', isset($model) ? $model->tracking_url : '') }}"/>
            @error('tracking_url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Input group-->



