@extends('layouts.app')

@section('title', 'Users')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Users</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.users')}}">Users</a></li>
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
         @if (checkUserPermission('user', 'create'))
        <div class="col-md-4 d-flex justify-content-end">
           <a class="btn btn-primary" href="{{ route('admin.users.create')}}">Add User</a>
        </div>
        @endif
        @include('layouts.includes.yajra_data_table')
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!--end::App Content-->
@endsection

@section('js')
<script>
    var ajax = true;
    var url = '{{ route('admin.users.destroy') }}'
</script>
<script src="{{ asset('public/js/custom/custom_function.js')}}"></script>
@endsection
