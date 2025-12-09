@extends('layouts.user.app2')

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
            <li class="breadcrumb-item"><a href="{{ route('user.units')}}">User Units</a></li>
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
