@extends('layouts.app')

@section('title', 'Royal Glory Residence Ltd')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Change Password</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
            <form action="{{ route('admin.change.password.submit')}}" method="post" id="change_password">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="password">New Password*</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password*</label>
                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Enter Confirm Password">
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
<script src="{{ asset('public/js/custom/change_password.js')}}"></script>
@endsection
