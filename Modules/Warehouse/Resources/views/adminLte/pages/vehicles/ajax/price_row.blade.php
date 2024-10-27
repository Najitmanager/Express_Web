<tr>
    <td>
        {{ $price->price }}
    </td>
    <td >{{ $price->as_of_date }}</td>
    <td>
        <button
            type="button"
            data-action="{{ fr_route('customers.price.destroy', [$price->client->id,$price->id]) }}"
            data-callback="delete-row"
            data-table-id="files"
            data-model-name="{{ __('warehouse::view.price') }}"
            data-time-alert="1100"
            class="delete-row btn btn-sm btn-danger btn-action-table btn-custom"
            data-toggle="tooltip" title="{{ __('view.delete') }}"
            data-modal-message="@lang('view.modal_message_delete')"
            data-modal-action="@lang('view.delete')"
        >
            <i class="fas fa-trash fa-fw"></i>
        </button>
    </td>
</tr>
