@extends('layouts.app')

@section('title', 'Royal Glory Residence Ltd')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Settings</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
        <div class="col-md-6">
            <div class="card card-primary">
            <!-- form start -->
            <form action="{{ route('admin.settingsUpdate')}}" method="post">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="password">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="{{ $settings->company_name }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" rows="3" name="address" placeholder="Address ..." autocomplete="off" spellcheck="false">{{ $settings->address }}</textarea>
                </div>
                <div class="form-group">
                    <label for="address">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $settings->phone }}">
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!--end::App Content-->
@endsection

@section('js')
@endsection
