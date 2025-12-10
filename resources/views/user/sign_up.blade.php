@extends('layouts.user.app2')

@section('title', 'User Create')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">User Create</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Create</li>
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
            <form action="{{ route('user.signUp.submit')}}" method="post" id="registration_form">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="password">Full Name*</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name')}}" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <label for="user_name">User Name*</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{ old('full_name')}}" placeholder="User Name">
                </div>
                <div class="form-group">
                    <label for="user_name">Phone*</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone')}}" placeholder="Phone">
                </div>
                <div class="form-group">
                    <label for="pin">PIN*</label>
                    <input type="text" class="form-control" id="pin" name="pin" value="{{ old('pin')}}" placeholder="Enter Your PIN">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="confirm_password">NID</label>
                    <input type="text" class="form-control" id="nid" name="nid" value="{{ old('nid') }}" placeholder="NID">
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation*</label>
                    <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Password Confirmation">
                </div>
                <div class="form-group">
                    <label for="statis">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" @selected(old('status') == 'active') >Active</option>
                        <option value="inactive" @selected(old('status') == 'inactive')>Inactive</option>
                    </select>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="{{ asset('public/js/custom/registration.js')}}"></script>
@endsection
