@csrf

<!--begin::Input group --  name -->
<div class="row mb-6">
    <!--begin::Label-->
    <label
        class="col-lg-4 col-form-label @if ($typeForm == 'create') required @endif fw-bold fs-6">{{ __('warehouse::view.port_name') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                   placeholder="{{ __('warehouse::view.port_name') }}"
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


<!--begin::Input group -- Country -->
<div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('warehouse::view.table.country') }}</label>
        <!--end::Label-->

        <!--begin::Input group-->
        <div class="col-lg-8 fv-row fv-row">
            <div class="mb-4">
                <select
                    class="form-control  @error('country_id') is-invalid @enderror"
                    name="country_id"
                    data-control="select2"
                    data-placeholder="{{ __('warehouse::view.table.choose_country') }}"
                    data-allow-clear="true"
                    id="change-country"
                >
                    <option></option>
                    @foreach(\Modules\Cargo\Entities\Country::all() as $country)
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
        </div>
        <!--end::Input group-->
</div>
<!--end::Input group-->


<!--begin::Input group --  City -->
<div class="row mb-6">
    <!--begin::Label-->
    <label
        class="col-lg-4 col-form-label @if ($typeForm == 'create') required @endif fw-bold fs-6">{{ __('warehouse::view.city') }}</label>
    <!--end::Label-->

    <!--begin::Input group-->
    <div class="col-lg-8 fv-row">
        <div class="input-group mb-4">
            <input type="text" name="city" class="form-control form-control-lg @error('city') is-invalid @enderror"
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
</div>
<!--end::Input group-->

