@csrf


<div class="row">
    <!--begin::Input group -- Company Name -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label required">{{ __('warehouse::view.company_name') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <input type="text" name="company_name"
                class="form-control form-control-lg @error('company_name') is-invalid @enderror"
                placeholder="{{ __('warehouse::view.company_name') }}"
                value="{{ old('company_name', isset($model) ? $model->user->name : '') }}" />
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
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label required">{{ __('warehouse::view.contact_full_name') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <input type="text" name="contact_full_name"
                class="form-control form-control-lg @error('contact_full_name') is-invalid @enderror"
                placeholder="{{ __('warehouse::view.contact_full_name') }}"
                value="{{ old('contact_full_name', isset($model) ? $model->contact_full_name : '') }}" />
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
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label ">{{ __('warehouse::view.phones') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="text" name="phones"
                class="form-control form-control-lg @error('phones') is-invalid @enderror"
                placeholder="{{ __('warehouse::view.phones') }}"
                value="{{ old('phones', isset($model) ? $model->phones : '') }}" />
            @error('phones')
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
<div class="form-group mb-0">
    <!--begin::Label-->
    <label class="col-form-label required">{{ __('warehouse::view.table.country') }}</label>
    <!--end::Label-->
    <select class="form-control  @error('country_id') is-invalid @enderror" name="country_id" data-control="select2"
        data-placeholder="{{ __('warehouse::view.table.choose_country') }}" data-allow-clear="true">
        <option></option>
        @foreach (get_countries() as $country)
            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}
                @if ($typeForm == 'edit') {{ $model->country_id == $country->id ? 'selected' : '' }} @endif>
                {{ $country->name }}</option>
        @endforeach
    </select>
    @error('country_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!--end::Input group-->

<!--begin::Input group -- Address Line -->
<div class="form-group mb-0">
    <label class="col-form-label required">{{ __('warehouse::view.address') }}</label>
    <textarea name="address" class="form-control @error('address') is-invalid @enderror"
        placeholder="{{ __('warehouse::view.address') }}">{{ old('address', isset($model) ? $model->address : '') }}</textarea>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


<div class="row">
    <!--begin::Input group -- City -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label required">{{ __('warehouse::view.city') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <input type="text" name="city"
                class="form-control form-control-lg @error('city') is-invalid @enderror"
                placeholder="{{ __('warehouse::view.city') }}"
                value="{{ old('city', isset($model) ? $model->city : '') }}" />
            @error('city')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- State -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label">{{ __('warehouse::view.state') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <input type="text" name="state"
                class="form-control form-control-lg @error('state') is-invalid @enderror"
                placeholder="{{ __('warehouse::view.state') }}"
                value="{{ old('state', isset($model) ? $model->state : '') }}" />
            @error('state')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


    <!--begin::Input group -- zip -->
    <!--begin::Input group-->
    <div class="col-lg-4 fv-row">
        <!--begin::Label-->
        <label class="col-form-label">{{ __('warehouse::view.zip') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <input type="text" name="zip" class="form-control form-control-lg @error('zip') is-invalid @enderror"
                placeholder="{{ __('warehouse::view.zip') }}"
                value="{{ old('zip', isset($model) ? $model->zip : '') }}" />
            @error('zip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

</div>

<!--begin::Input group -- emails -->
<div class="form-group mb-0">
    <!--begin::Label-->
    <label class="col-form-label required">{{ __('warehouse::view.booking_emails') }}</label>
    <!--end::Label-->
    {{-- <select
        class="form-control  @error('booking_emails') is-invalid @enderror"
        name="booking_emails[]"
        data-control="select2" --}}
    {{--        data-placeholder="{{ __('warehouse::view.choose_booking_emails') }}" --}}
    {{--        data-allow-clear="true" --}}
    {{-- multiple="multiple"
    >
    </select> --}}
    <input type="email" name="email" class="form-control form-control-lgr"
        placeholder="{{ __('warehouse::view.choose_booking_emails') }}" />
    @error('country_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!--end::Input group-->
<!--begin::Input group -- Login Credentials -->
<div class="card card-secondary border-1 border-secondary mt-8" style="border: 1px solid #eff2f5; position: relative; border-radius: 0">
    <h3 class="text-secondary" style="
        color: #ffffff; 
        position: absolute;
        top: -15px;
        left: 18px;
        background: white;
        padding: 3px 10px;
        border-radius: 10px;
        font-size: 16px !important;">
        {{ __('warehouse::view.login_credentials') }}
    </h3>

    <div class="card-body px-5 pt-5 py-0" style="background-color: #f6f6f6">
        <div class="row">
            <!--begin::Input group -- Email -->
            <div class="col-lg-6 fv-row mb-3">
                <!--begin::Label-->
                <label class="col-form-label ">{{ __('warehouse::view.email') }}</label>
                <!--end::Label-->
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" name="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="{{ __('warehouse::view.email') }}"
                        value="{{ old('email', isset($model) ? $model->user->email : '') }}" />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group -- Password -->
            <div class="col-lg-3 fv-row mb-3">
                <!--begin::Label-->
                <label
                    class="col-form-label @if ($typeForm == 'create') required @endif">{{ __('cargo::view.table.password') }}</label>
                <!--end::Label-->
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" id="password" name="password"
                        class="form-control form-control-lg has-feedback @error('password') is-invalid @enderror"
                        placeholder="{{ __('cargo::view.table.password') }}"
                        value="{{ old('password', isset($model) ? $model->password : '') }}" />
                    <i id="check" class="far fa-eye" id="togglePassword"
                        style="cursor: pointer;position: absolute;right: 0;padding:6%;font-size: 16px;"></i>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!--end::Input group-->

            <!--begin::Input group -- Password Confirmation -->
            <div class="col-lg-3 fv-row mb-3">
                <!--begin::Label-->
                <label
                    class="col-form-label @if ($typeForm == 'create') required @endif">{{ __('warehouse::view.password_confirmation') }}</label>
                <!--end::Label-->
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control form-control-lg has-feedback @error('password_confirmation') is-invalid @enderror"
                        placeholder="{{ __('warehouse::view.password_confirmation') }}" />
                    @error('password')
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
<!--end::Input group-->
