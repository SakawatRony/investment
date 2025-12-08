@extends('layouts.app')

@section('title', 'Unit Create')
@section('css')
  <!-- DataTables -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

@endsection
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Unit Lists</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Units</li>
        </ol>
        </div>
    </div>
    <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
            <!-- form start -->
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Remark</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($units as $unit)
                    <tr>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->params }}</td>
                    <td>
                        <a data-bs-toggle="tooltip" title="Edit" href="#" class="btn btn-primary"><i class="bi bi-arrow-right-square"></i></a>
                        <a data-bs-toggle="tooltip" title="Delete" href="javascript:void(0)" class="delete btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                    </td>
                  </tr>
                    @endforeach
                  </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!--end::App Content-->
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


<script>
  $(function () {
    let table = $("#example1").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        paging: true,
        searching: true, // চাইলে true/false
        ordering: true,
        info: true,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });

    table.buttons().container()
        .appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
@endsection
