@extends('layouts.app')

@section('title', 'Permission')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Permission</h3></div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permission</li>
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
        <div class="col-md-12">
            <div class="card card-primary">
            <!-- form start -->
            <form action="{{ route('admin.settings.permission.update', $roles->id)}}" method="post">
                @csrf

                <table class="table">
                    <thead>
                        <tr>
                        <th>Permission name</th>
                        <th colspan="4">Action</th>
                        </tr>
                    </thead>
                    @php
                      $userPermission = json_decode($roles->permissions, true);
                     // $userPermission['permission'];
                    @endphp
                    <tbody>
                        @foreach (config('permission.data') as $key => $permissions)
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                            @foreach ($permissions as $permission)
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission[{{ $key }}][{{ $permission }}]" {{ isset($userPermission['permission']) && isset($userPermission['permission'][$key]) && isset($userPermission['permission'][$key][$permission]) && $userPermission['permission'][$key][$permission] == 'on' ? 'checked': null }}>
                                    <label class="form-check-label">{{ ucwords(str_replace('_', ' ', $permission)) }}</label>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                        <!-- more rows here -->
                    </tbody>
                    </table>

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
