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

        var unitId = $(this).attr('data-id');
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
            url: SITE_URL + "/units/destroy",
            // data that will be sent
            data: {
                id: unitId,
                "_token": token
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if(data.status == '1') {
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your data has been deleted.",
                    icon: "success"
                    });
                   location.reload();
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
