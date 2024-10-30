@csrf




<div class="row mb-6">
    <!--begin::Input group -- Name -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.name') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('warehouse::view.name') }}" value="{{ old('name', isset($model) ? $model->name : '') }}" />
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group -- phone -->
    <!--begin::Input group-->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.phone') }}</label>
        <!--end::Label-->
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="text" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" placeholder="{{ __('warehouse::view.phone') }}" value="{{ old('phone', isset($model) ? $model->phone : '') }}" />
            @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

</div>
<!--end::Input group-->

<div class="form-group">
    <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.address') }}</label>
    <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="{{ __('warehouse::view.address') }}">{{ old('address', isset($model) ? $model->address : '') }}</textarea>
    @error('address')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


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
    <label class="col-form-label fw-bold fs-6 required">{{ __('warehouse::view.city') }}</label>
    <input type="text" value="{{ old('city', isset($model) ? $model->city : '') }}" placeholder="{{ __('warehouse::view.city') }}" name="city" class="form-control @error('city') is-invalid @enderror" />
    @error('city')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

