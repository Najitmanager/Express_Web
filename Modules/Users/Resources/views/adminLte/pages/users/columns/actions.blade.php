<!-- begin: Dropdown Menu -->
<div class="btn-group" role="group" aria-label="Actions">
    <button type="button" class="btn btn-sm  dropdown-toggle custom-dropdown" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
    </button>
    <div class="dropdown-menu custom-drodown-content" aria-labelledby="dropdownMenuButton">

        <!-- begin: Btn View profile Row -->
        @can('view-profile-users')
            <div>
                <a href="{{ fr_route('users.show', $model->id) }}" class="btn btn-sm btn-action-table px-3"
                    data-toggle="tooltip" title="{{ __('view.view_profile') }}">
                    <i class="fas fa-eye fa-fw text-primary"></i> {{ __('view.view_profile') }}
                </a>
            </div>
        @endcan
        <!-- end: Btn View profile Row -->

        <!-- begin: Btn Edit Row -->
        @can('edit-users')
            <div>
                <a href="{{ fr_route('users.edit', $model->id) }}" class="btn btn-sm btn-action-table px-3"
                    data-toggle="tooltip" title="{{ __('view.edit') }}">
                    <i class="fas fa-edit fa-fw text-success"></i> {{ __('view.edit') }}
                </a>
            </div>
        @endcan
        <!-- end: Btn Edit Row -->


        @can('delete-users')
            @if ($model->id != 1)
                <div>
                    <button type="button" data-action="{{ fr_route('users.destroy', $model->id) }}"
                        data-callback="reload-table" data-table-id="{{ isset($table_id) ? $table_id : '' }}"
                        data-model-name="{{ __('users::view.table.user') }}" data-time-alert="2000"
                        class="delete-row btn btn-sm btn-action-table btn-custom px-3" data-toggle="tooltip"
                        title="{{ __('view.delete') }}" data-modal-message="@lang('view.modal_message_delete')"
                        data-modal-action="@lang('view.delete')">
                        <i class="fas fa-trash fa-fw text-danger"></i> {{ __('view.delete') }}
                    </button>
                </div>
            @endif
        @endcan
        <!-- end: Btn Delete Row -->

        <!-- begin: Btn manage access -->
        @admin
            <div>
                <a href="{{ fr_route('users.manage-access', $model->id) }}" class="btn btn-sm btn-action-table px-3"
                    data-toggle="tooltip" title="{{ __('view.manage_access') }}">
                    <i class="fas fa-universal-access fa-fw text-info"></i> {{ __('view.manage_access') }}
                </a>
            </div>
        @endadmin
        <!-- end: Btn manage access -->
    </div>
</div>
<!-- end: Dropdown Menu -->

<!-- begin: Btn Delete Row -->
{{-- 
    data-callback = reload-page, reload-table, delete-row
--}}
