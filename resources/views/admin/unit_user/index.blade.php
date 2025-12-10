@extends('layouts.app')

@section('title', 'Users units')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Units</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.units.user')}}">User Units</a></li>
            <li class="breadcrumb-item active">List</li>
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
        <div class="col-md-4 d-flex justify-content-end">
           <a class="btn btn-primary" href="{{ route('admin.units.user.create')}}">Add User Unit PINs</a>
        </div>
        @include('layouts.includes.yajra_data_table')
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!--end::App Content-->
@endsection

@section('js')
<script>
    var url = '{{ route('admin.units.user.destroy') }}';
    var ajax = true;
</script>
<script src="{{ asset('public/js/custom/user_list.js')}}"></script>
<script src="{{ asset('public/js/custom/custom_function.js')}}"></script>

@endsection
