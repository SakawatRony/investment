@extends('layouts.app')

@section('title', 'Invoice')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Invoice Amount</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.user.allCommission')}}">Applicable Invoices</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
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
            <form action="{{ route('admin.user.generateInvoice', $commission->id)}}" method="post">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="price">Price*</label><small> (this amount {{ $commission->commission}}% will be counted as user balance.)</small>
                    <input type="text" required class="form-control" id="price" name="price" placeholder="Enter Invoice Price">
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" class="btn btn-primary">Continue</button>
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
