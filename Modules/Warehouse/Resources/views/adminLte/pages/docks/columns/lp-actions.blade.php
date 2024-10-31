



    <!-- begin: Dropdown Menu -->
<div class="btn-group" role="group" aria-label="Actions">
    <button type="button" class="btn btn-sm  dropdown-toggle custom-dropdown" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
    </button>
    <div class="dropdown-menu custom-drodown-content" aria-labelledby="dropdownMenuButton">
        <!-- begin: Btn Edit Row -->

        <a href="{{ fr_route('docks.show', $model->id) }}"></a>

            <div>
                <a href="{{ fr_route('docks.edit', $model->id) }}" class="btn btn-sm btn-action-table px-3"
                   data-toggle="tooltip" title="{{ __('view.edit') }}">
                    <i class="fas fa-edit fa-fw text-warning"></i> {{ __('view.edit') }}
                </a>
            </div>

        <!-- end: Btn Edit Row -->


        <div>
            <button type="button" data-action="{{ fr_route('docks.destroy', $model->id) }}"
                    data-callback="reload-table" data-table-id="{{ isset($table_id) ? $table_id : '' }}"
                    data-model-name="{{ __('warehouse::view.table.dock') }}" data-time-alert="2000"
                    class="delete-row btn btn-sm btn-action-table btn-custom px-3" data-toggle="tooltip"
                    title="{{ __('view.delete') }}" data-modal-message="@lang('view.modal_message_delete')"
                    data-modal-action="@lang('view.delete')">
                <i class="fas fa-trash fa-fw text-danger"></i> {{ __('view.delete') }}
            </button>
        </div>


    </div>
</div>
<!-- end: Dropdown Menu -->
