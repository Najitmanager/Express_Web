<div class="row">
<!--begin::Input group -- Make -->
<div class="col-lg-5 fv-row">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.table.make') }}</label>
    <!--end::Label-->
    <div class="input-group mb-4">
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
                    {{ $make_id == $make->id ? 'selected' : '' }}
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
    <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.table.model') }}</label>
    <!--end::Label-->
    <div class="input-group mb-4">
        <select
            class="form-control  @error('model_id') is-invalid @enderror"
            name="model_id"
            id="model-select"
            {{--                    data-control="select2"--}}
            data-placeholder="{{ __('warehouse::view.table.choose_model') }}"
            data-allow-clear="true">
            <option></option>
            @foreach(get_models($make_id) as $model)
                <option value="{{ $model->id }}"
                    {{ $model_id == $model->id ? 'selected' : '' }}
                >{{ $model->name }}</option>
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

<!--begin::Input group -- year -->
<div class="col-lg-2 fv-row">
    <!--begin::Label-->
    <label class="col-form-label fw-bold fs-6">{{ __('warehouse::view.table.year') }}</label>
    <!--end::Label-->
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa-solid fa-calendar-plus"></i></span>
        </div>
        <input type="number" name="year" class="form-control  has-feedback @error('year') is-invalid @enderror" placeholder="{{ __('warehouse::view.table.year') }}"  value="{{ $year }}" />
        @error('year')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<!--end::Input group-->
</div>
<script>
    $('#make-select').on('change', function () {
        const makeId = $(this).val();

        if (makeId) {
            // Make AJAX request to get models based on selected make
            $.ajax({
                url: `/get-models/${makeId}`, // Adjust the endpoint as needed
                type: 'GET',
                success: function (data) {
                    // Clear old data in the model-select dropdown
                    $('#model-select').empty();

                    // Append new options to model-select
                    {{--$('#model-select').append('<option>{{ __('warehouse::view.table.choose_model') }}</option>');--}}
                    data.models.forEach(function (model) {
                        $('#model-select').append(
                            `<option value="${model.id}">${model.name}</option>`
                        );
                    });

                    // Refresh Select2 to show updated options
                    // $('#model-select').select2();
                },
                error: function () {
                    console.error("Failed to fetch models.");
                }
            });
        } else {
            // Clear model-select if no make is selected
            $('#model-select').empty().append('<option>{{ __('warehouse::view.table.choose_model') }}</option>').select2();
        }
    });
</script>
