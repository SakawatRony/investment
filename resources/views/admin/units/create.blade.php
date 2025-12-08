@extends('layouts.app')

@section('title', 'Unit Create')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Create Unit</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Unit</li>
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
            <form action="{{ route('admin.units.store')}}" method="post" id="unit_create">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="name">Name*</label>
                    <input type="text" required class="form-control" id="name" name="name" placeholder="Unit Name">
                </div>
                <div class="form-group">
                    <label for="param">Remarks</label>
                    <textarea class="form-control" name="param" rows="3" placeholder="Enter ..." autocomplete="off" spellcheck="false"></textarea>
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

@endsection
