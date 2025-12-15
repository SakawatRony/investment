@extends('layouts.app')

@section('title', 'User Units Create')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">User Units Create</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.units.user')}}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
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
            <form action="{{ route('admin.units.user.store')}}" method="post" id="user_units_form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_id">Select Unit For*</label>
                        <select class="form-control select2 p-3" name="user_id" id="user_id" required>
                            <option value="">Select One</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_value">Unit*</label>
                        <input type="number" min="0" step="any" class="form-control" id="unit_value" required name="unit_value" value="{{ old('unit_value')}}" placeholder="Enter Point Number">
                    </div>
                    <div class="form-group">
                        <label for="total_number">Total Number of Pin*</label>
                        <input type="number" min="1" step="1" class="form-control" id="total_number" required name="total_number" value="{{ old('total_number')}}" placeholder="Total Number">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('public/js/custom/user_units.js')}}"></script>
@endsection
