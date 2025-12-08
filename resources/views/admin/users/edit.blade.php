@extends('layouts.app')

@section('title', 'User Edit')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">User Edit</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.users')}}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <form action="{{ route('admin.users.update', $user->id)}}" method="post" id="user_update">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="password">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->full_name}}" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email}}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="confirm_password">NID</label>
                    <input type="text" class="form-control" id="nid" name="nid" value="{{ $user->nid}}" placeholder="NID">
                </div>
                <div class="form-group">
                    <label for="statis">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" @selected($user->status == 'active') >Active</option>
                        <option value="inactive" @selected($user->status == 'inactive')>Inactive</option>
                    </select>
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
