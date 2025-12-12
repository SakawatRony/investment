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
                <ul>
                    <li>
                        <a class="white_color bg-success" href="javascript:void(0)"><h3>{{ $userData->user_name }}</h3></a>
                        @php
                           $childs = $referralUser;
                        @endphp
                        <ul>
                            @foreach($childs as $child)
                            @php
                            $count = 1;
                            @endphp
                                <li>
                                    <a class="white_color bg-info" href="javascript:void(0)" title="{{ $child->unitUser?->unit_name }}"><h3>{{ $child->user?->user_name }}</h3></a>
                                    @php
                                        $grandChilds = App\Models\ReferralUser::where('referral_id', $child->user_id)->get()
                                    @endphp
                                    @if(!empty($grandChilds) && count($grandChilds) > 0)
                                        {{-- @include('user.child', ['grandChilds' => $grandChilds, 'count' => $count]) --}}
                                        <ul>
                                            @foreach($grandChilds as $grand)
                                                <li><a class="white_color bg-warning"  href="javascript:void(0)" title="{{ $grand->unitUser?->unit_name }}"><h3>{{ $grand->user?->user_name }}</h3></a>
                                                    @php
                                                        $grandgrandChilds = App\Models\ReferralUser::where('referral_id', $grand->user_id)->get();
                                                    @endphp
                                                    @if(!empty($grandgrandChilds) && count($grandgrandChilds) > 0)

                                                    <ul>
                                                        @foreach($grandgrandChilds as $grandgrand)
                                                            <li><a class="white_color bg-danger"  href="javascript:void(0)" title="{{ $grandgrand->unitUser?->unit_name }}"><h3>{{ $grandgrand->user?->user_name }}</h3></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
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
