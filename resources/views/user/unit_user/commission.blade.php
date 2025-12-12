@extends('layouts.user.app2')

@section('title', 'Commission')

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
            <li class="breadcrumb-item"><a href="{{ route('user.commissions')}}">Commission</a></li>
            <li class="breadcrumb-item active">Commissions</li>
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
        @if (!empty($total_pont_value) && $total_pont_value> 0)
        <div class="col-md-12 d-flex justify-content-end">
        <h3 class="text-primary"> Total Point Value: {{ $total_pont_value }}</h3>
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
</script>
@endsection
