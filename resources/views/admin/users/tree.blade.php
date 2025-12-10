@extends('layouts.app')

@section('title', 'User Tree')

@section('css')
 <link rel="stylesheet" href="{{ asset('public/css/custom/tree.css') }}" />
@endsection

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
            <li class="breadcrumb-item"><a href="{{ route('admin.users')}}">User</a></li>
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
        <div class="col-md-12 d-flex justify-content-center">
            <div class="card card-primary pt-2 pb-2">
                <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
        {{--Multi tier div--}}
        @if(isset($referralUser) && count($referralUser) > 0)
            <div class="tree">
                <h3 class="mb-0 text-center">Here will show user tree</h3>
                <ul>
                    <li>
                        <a href="javascript:void(0)">{{ auth()->user()->user_name }}</a>
                        @php
                           $childs = $referralUser;

                        @endphp
                        <ul>
                            @foreach($childs as $child)
                                <li>
                                    <a href="javascript:void(0)">{{ $child->user?->user_name }}</a>
                                    @php
                                        $grandChilds = App\Models\ReferralUser::where('referral_id', $child->user_id)->get()
                                    @endphp
                                    @if(!empty($grandChilds) && count($grandChilds) > 0)
                                        @include('user.child', ['grandChilds' => $grandChilds])
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        @else
            <span>{{ __('There is no tree!') }}</span>
        @endif
           </div>
        </div>
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
