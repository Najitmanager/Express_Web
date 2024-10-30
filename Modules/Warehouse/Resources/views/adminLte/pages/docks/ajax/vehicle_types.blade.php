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
            {{ $type_id == $type->id ? 'selected' : '' }}
        >{{ $type->name }}</option>
    @endforeach
</select>
@error('type_id')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
