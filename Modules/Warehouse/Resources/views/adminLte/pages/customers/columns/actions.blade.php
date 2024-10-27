@php
    $user_role = auth()->user()->role;
    $admin  = 1;
@endphp
    <!-- begin: Btn View profile Row -->

<!-- end: Btn View profile Row -->
<!-- begin: Btn Edit Row -->
@if(/*auth()->user()->can('edit-currencies') ||*/ $user_role == $admin)
    <a
        href="{{ fr_route('customers.edit', $model->id) }}"
        class="btn btn-sm btn-secondary btn-action-table"
        data-toggle="tooltip" title="{{ __('view.edit') }}"
        >
        <i class="fas fa-edit fa-fw"></i>
    </a>
@endif
<!-- end: Btn Edit Row -->

<!-- begin: Btn Delete Row -->
{{--
    data-callback = reload-page, reload-table, delete-row
--}}

{{--@can('delete-users')--}}
{{--    @if ($model->id != 1)--}}
        <button
            type="button"
            data-action="{{ fr_route('customers.destroy', $model->id) }}"
            data-callback="reload-table"
            data-table-id="{{ isset($table_id) ? $table_id : '' }}"
            data-model-name="{{ __('warehouse::view.table.customer') }}"
            data-time-alert="2000"
            class="delete-row btn btn-sm btn-secondary btn-action-table btn-custom"
            data-toggle="tooltip" title="{{ __('view.delete') }}"
            data-modal-message="@lang('view.modal_message_delete')"
            data-modal-action="@lang('view.delete')"
        >
            <i class="fas fa-trash fa-fw"></i>
        </button>
{{--    @endif--}}
{{--@endcan--}}
<!-- end: Btn Delete Row -->
