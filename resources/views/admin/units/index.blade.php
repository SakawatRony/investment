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
         <div class="col-md-4"></div>
         <div class="col-md-4"></div>
        <div class="col-md-4 d-flex justify-content-end mb-2">
           <a class="btn btn-primary" href="{{ route('admin.units.create')}}">Add Unit</a>
        </div>
        <br>
        <div class="col-md-12">
            <div class="card card-primary">
            <!-- form start -->
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Remark</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($units as $unit)
                    <tr>
                    <td class="text-center">{{ $unit->name }}</td>
                    <td class="text-center">{{ $unit->params }}</td>
                    <td class="text-center">
                        <a data-bs-toggle="tooltip" title="Edit" href="{{ route('admin.units.edit', $unit->id)}}" class="btn btn-primary"><i class="bi bi-arrow-right-square"></i></a>
                        <a data-bs-toggle="tooltip" title="Delete" href="javascript:void(0)" class="delete btn btn-danger" data-id="{{ $unit->id }}" id="delete"><i class="bi bi-archive-fill"></i></a>
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
<script src="{{ asset('public/js/custom/unit.js')}}"></script>
@endsection
