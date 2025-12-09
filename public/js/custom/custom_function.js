'use strict'

 $(function () {
    let table = $("#example1").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        paging: true,
        searching: true, // চাইলে true/false
        ordering: true,
        info: true,
    });
});

$(document).on('click', '.delete', function (e) {
        var id = $(this).attr('data-id');
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
            url: url,
            // data that will be sent
            data: {
                id: id,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if(data.status == '1') {
                    Swal.fire({
                    title: "Deleted!",
                    text: data.message,
                    icon: "success"
                    });
                    if (ajax == true) {
                       table.ajax.reload(null, false);
                    } else {
                        location.reload();
                    }
                } else {
                    Swal.fire({
                    title: "Opps!",
                    text: data.message,
                    icon: "error"
                    });
                }
            }
            });
        }
        });
    });
