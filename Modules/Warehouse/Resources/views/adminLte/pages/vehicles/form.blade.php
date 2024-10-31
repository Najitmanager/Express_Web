@csrf
{{--<div class="card card-secondary" style="border: 1px solid #eff2f5">--}}
{{--    <div class="card-header">--}}
{{--        <h3 class="card-title" style="color: #ffffff;">{{ __('warehouse::view.login_credentials') }}</h3>--}}
{{--    </div>--}}

{{--    --}}
{{--</div>--}}

<div class="card-body p-0">
    <div class="row">
        <!--begin::Input group -- VIN -->
        <div class="col-lg-6 fv-row">
            <!--begin::Label-->
            <label class="col-form-label ">{{ __('warehouse::view.vin') }}</label>
            <!--end::Label-->
            <div class="input-group">
                <input type="text" name="vin" class="form-control rounded-0 @error('vin') is-invalid @enderror"
                       placeholder="{{ __('warehouse::view.vin') }}"
                       id="vin_input"
                       value="{{ old('vin', isset($model) ? $model->vin : '') }}">
                <span class="input-group-append">
                        <button type="button" id="pull_info" class="btn btn-custom-save btn-flat" style="height: auto">{{ __('warehouse::view.pull_vehicle_info') }}</button>
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
            <label class="col-form-label">{{ __('cargo::view.table.type') }}</label>
            <!--end::Label-->
            <div class="input-group vehicle_type">
                <select
                    class="form-control @error('type_id') is-invalid @enderror"
                    name="type_id"
{{--                    data-control="select2"--}}
                    data-placeholder="{{ __('warehouse::view.table.choose_type') }}"
                    data-allow-clear="true"
                >
                    <option></option>
                    @foreach(get_types() as $type)
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
        <div class="col-lg-12  vehicle_info">
            <div class="row">
                <!--begin::Input group -- Make -->
                <div class="col-lg-5 fv-row">
                    <!--begin::Label-->
                    <label class="col-form-label">{{ __('warehouse::view.table.make') }}</label>
                    <!--end::Label-->
                    <div class="input-group">
                        <select
                            class="form-control  @error('make_id') is-invalid @enderror"
                            name="make_id"
                            id="make-select"
                            {{--                    data-control="select2"--}}
                            data-placeholder="{{ __('warehouse::view.table.choose_make') }}"
                            data-allow-clear="true">
                            <option></option>
                            @foreach(get_makes() as $make)
                                <option value="{{ $make->id }}"
                                    {{ old('make_id') == $make->id ? 'selected' : '' }}
                                @if($typeForm == 'edit')
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

                <!--begin::Input group -- model -->
                <div class="col-lg-5 fv-row">
                    <!--begin::Label-->
                    <label class="col-form-label">{{ __('warehouse::view.table.model') }}</label>
                    <!--end::Label-->
                    <div class="input-group">
                        <select
                            class="form-control  @error('model_id') is-invalid @enderror"
                            name="model_id"
                            id="model-select"
                            {{--                    data-control="select2"--}}
                            data-placeholder="{{ __('warehouse::view.table.choose_model') }}"
                            data-allow-clear="true">
                            <option></option>

                        </select>
                        @error('make_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group -- year -->
                <div class="col-lg-2 fv-row">
                    <!--begin::Label-->
                    <label class="col-form-label">{{ __('warehouse::view.table.year') }}</label>
                    <!--end::Label-->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-plus"></i></span>
                        </div>
                        <input type="number" name="year" class="form-control  has-feedback @error('year') is-invalid @enderror" placeholder="{{ __('warehouse::view.table.year') }}"  />
                        @error('year')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <!--end::Input group-->
            </div>
        </div>

        <!--begin::Input group -- Color -->
        <div class="col-lg-4 fv-row">
            <!--begin::Label-->
            <label class="col-form-label">{{ __('warehouse::view.table.color') }}</label>
            <!--end::Label-->
            <div class="input-group">
                <select
                    class="form-control  @error('color_id') is-invalid @enderror"
                    name="color_id"
{{--                    data-control="select2"--}}
                    data-placeholder="{{ __('warehouse::view.table.choose_color') }}"
                    data-allow-clear="true"
                >
                    <option></option>
                    @foreach(get_colors() as $color)
                        <option value="{{ $color->id }}"
                            {{ old('color_id') == $color->id ? 'selected' : '' }}
                        @if($typeForm == 'edit')
                            {{ $model->color_id == $color->id ? 'selected' : '' }}
                            @endif
                        >{{ $color->name }}</option>
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

        <!--begin::Input group -- Price -->
        <div class="col-lg-4 fv-row">
            <!--begin::Label-->
            <label class="col-form-label">{{ __('warehouse::view.table.price') }}</label>
            <!--end::Label-->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                </div>
                <input type="text" name="price" class="form-control has-feedback @error('price') is-invalid @enderror" placeholder="{{ __('warehouse::view.table.price') }}"  />
                @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group -- weight -->
        <div class="col-lg-4 fv-row">
            <!--begin::Label-->
            <label class="col-form-label">{{ __('warehouse::view.table.price') }}</label>
            <!--end::Label-->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-solid fa-weight-scale"></i></span>
                </div>
                <input type="text" name="weight" class="form-control has-feedback @error('weight') is-invalid @enderror" placeholder="{{ __('warehouse::view.table.weight') }}"  />
                @error('weight')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <!--end::Input group-->

    </div>
</div>

<div class="row">
    <!--begin::Input group -- Customer -->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label
            class="col-form-label required">{{ __('warehouse::view.customer') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <select
                class="form-control  @error('client_id') is-invalid @enderror"
                name="client_id"
{{--                data-control="select2"--}}
                data-placeholder="{{ __('warehouse::view.table.choose_customer') }}"
                data-allow-clear="true"
            >
                <option></option>
                @foreach(get_customers() as $customer)
                    <option value="{{ $customer->id }}"
                        {{ old('client_id') == $customer->id ? 'selected' : '' }}
                    @if($typeForm == 'edit')
                        {{ $model->client_id == $customer->id ? 'selected' : '' }}
                        @endif
                    >{{ $customer->user->name }}</option>
                @endforeach
            </select>
            @error('client_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- Port -->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label
            class="col-form-label required">{{ __('warehouse::view.port') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <select
                class="form-control  @error('port_id') is-invalid @enderror"
                name="port_id"
{{--                data-control="select2"--}}
                data-placeholder="{{ __('warehouse::view.table.choose_port') }}"
                data-allow-clear="true"
            >
                <option></option>
                @foreach(get_ports() as $port)
                    <option value="{{ $port->id }}"
                        {{ old('port_id') == $port->id ? 'selected' : '' }}
                    @if($typeForm == 'edit')
                        {{ $model->port_id == $port->id ? 'selected' : '' }}
                        @endif
                    >{{ $port->name }}</option>
                @endforeach
            </select>
            @error('port_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- expected_arrival_date -->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label">{{ __('warehouse::view.table.expected_arrival_date') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <input type="date" name="expected_arrival_date" class="form-control has-feedback @error('expected_arrival_date') is-invalid @enderror" placeholder="{{ __('warehouse::view.table.expected_arrival_date') }}"  />
            @error('expected_arrival_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->

    <!--begin::Input group -- lot -->
    <div class="col-lg-6 fv-row">
        <!--begin::Label-->
        <label class="col-form-label">{{ __('warehouse::view.table.lot') }}</label>
        <!--end::Label-->
        <div class="input-group">
            <input type="text" name="lot" class="form-control has-feedback @error('lot') is-invalid @enderror" placeholder="{{ __('warehouse::view.table.lot') }}"  />
            @error('lot')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <!--end::Input group-->


</div>
<!--end::Input group-->
