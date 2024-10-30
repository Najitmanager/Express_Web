<form id="form_body-edit" class="form" action="{{ fr_route('bookings.update', ['id' => $model->id]) }}" method="post"
    enctype="multipart/form-data">
    @method('PUT')
    <div class="modal-body">
        <!--begin::Card body-->
        <div class="card-body border-top px-9">
            @include('warehouse::adminLte.pages.bookings.form', ['typeForm' => 'edit'])
        </div>
        <!--end::Card body-->

    </div>
    <div class="modal-footer justify-content-navbar">
        <button type="button" class="btn btn-custom-discard" id="form_submit-discard" data-dismiss="modal"><i class="fa-solid fa-ban"></i>
            @lang('view.discard')</button>
        <button type="button" class="btn btn-custom-save" id="form_submit-edit"><i
                class="fa-regular fa-floppy-disk"></i> @lang('view.update')</button>
    </div>
</form>
<script>

    $('#form_submit-edit').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        let formData = new FormData($('#form_body-edit')[0]); // Gather form data

        $.ajax({
            url: $('#form_body-edit').attr('action'), // Get form action URL
            type: 'POST',
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            success: function(response) {
                // Handle success response
                if (response.success) {
                    Toast.fire({
                        icon: 'success',
                        title: 'consignee updated successfully!'
                    })
                    // Close the edit modal
                    setTimeout(function() {
                        $('#modal-overlay-edit').modal('hide');
                    }, 1000);
                    // Reload the table
                    var tableId = '{{ $table_id }}';
                    var table = $('#' + tableId);
                    table.DataTable().ajax.reload()
                } else {
                    alert('Failed to update consignee. Please try again.');
                }
            },
            error: function(xhr) {
                // Handle error response
                alert('An error occurred. Please try again.');
                console.error(xhr.responseText); // Log error for debugging
            }
        });
    });

    $('#form_submit-discard').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission
        $('#modal-overlay-edit').modal('hide');
    });

    $('#modal-close').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission
        $('#modal-overlay-edit').modal('hide');
    });
</script>
