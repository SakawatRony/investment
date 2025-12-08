'use strict'
$(document).on('click', '.delete', function (e) {

        var userId = $(this).attr('data-id');
        let table = $('#dataTableBuilder').DataTable();
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
            url: SITE_URL + "/users/destroy",
            // data that will be sent
            data: {
                id: userId,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if(data.status == '1') {
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                    table.ajax.reload(null, false);
                } else {
                    Swal.fire({
                    title: "Opps!",
                    text: "Something went wrong!",
                    icon: "error"
                    });
                }
            }
            });
        }
        });
    });
