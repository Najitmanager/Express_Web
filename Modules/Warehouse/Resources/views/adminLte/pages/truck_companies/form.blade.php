@csrf


<div class="row mb-6">
    <!--begin::Input group -- Company Name -->
    <!--begin::Input group-->
    <div class="col-lg-3 fv-row">
        <!--begin::Label-->
        <label
            class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.truck_company_name') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="company_name"
                   class="form-control form-control-lg @error('company_name') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.truck_company_name') }}"
                   value="{{ old('company_name', isset($model) ? $model->company_name : '') }}"/>
            @error('company_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Contact Full Name -->
    <!--begin::Input group-->
    <div class="col-lg-3 fv-row">
        <!--begin::Label-->
        <label
            class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.contact_full_name') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="contact_full_name"
                   class="form-control form-control-lg @error('contact_full_name') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.contact_full_name') }}"
                   value="{{ old('contact_full_name', isset($model) ? $model->contact_full_name : '') }}"/>
            @error('contact_full_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


    <!--begin::Input group -- phones -->
    <!--begin::Input group-->
    <div class="col-lg-3 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 ">{{ __('warehouse::view.phones') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="text" name="phones"
                   class="form-control form-control-lg @error('phones') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.phones') }}"
                   value="{{ old('phones', isset($model) ? $model->phones : '') }}"/>
            @error('phones')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Email -->
    <!--begin::Input group-->
    <div class="col-lg-3 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 ">{{ __('warehouse::view.email') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" name="email"
                   class="form-control form-control-lg @error('email') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.email') }}"
                   value="{{ old('email', isset($model) ? $model->email : '') }}"/>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

</div>
<!--end::Input group-->


<!--begin::Input group-->
<div class="form-group">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.table.country') }}</label>
    <!--end::Label-->
    <select
        class="form-control  @error('country_id') is-invalid @enderror"
        name="country_id"
        data-control="select2"
        data-placeholder="{{ __('warehouse::view.table.choose_country') }}"
        data-allow-clear="true"
    >
        <option></option>
        @foreach(get_countries() as $country)
            <option value="{{ $country->id }}"
                {{ old('country_id') == $country->id ? 'selected' : '' }}
            @if($typeForm == 'edit')
                {{ $model->country_id == $country->id ? 'selected' : '' }}
                @endif
            >{{ $country->name }}</option>
        @endforeach
    </select>
    @error('country_id')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<!--end::Input group-->


<div class="form-group">
    <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.address') }}</label>
    <textarea name="address" class="form-control @error('address') is-invalid @enderror"
              placeholder="{{ __('warehouse::view.address') }}">{{ old('address', isset($model) ? $model->address : '') }}</textarea>
    @error('address')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


<div class="row mb-6">
    <!--begin::Input group -- Company Name -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.city') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="city"
                   class="form-control form-control-lg @error('city') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.city') }}"
                   value="{{ old('city', isset($model) ? $model->city : '') }}"/>
            @error('city')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Contact Full Name -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.state') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="state"
                   class="form-control form-control-lg @error('state') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.state') }}"
                   value="{{ old('state', isset($model) ? $model->state : '') }}"/>
            @error('state')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


    <!--begin::Input group -- phones -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.zip') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="zip"
                   class="form-control form-control-lg @error('zip') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.zip') }}"
                   value="{{ old('zip', isset($model) ? $model->zip : '') }}"/>
            @error('zip')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

</div>
