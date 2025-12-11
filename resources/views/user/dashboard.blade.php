@extends('layouts.user.app2')

@section('title', 'Royal Glory Residence Ltd')

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
              <!--begin::Col-->

              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>{{ $balance->amount ?? 0 }}</h3>
                    <p>Balance</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                  </svg>
                </div>
                <!--end::Small Box Widget 1-->
              </div>

              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-primary">
                  <div class="inner">
                    <h3>{{ $totalReferral }}</h3>
                    <p>Total Refer User</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                  </svg>
                </div>
                <!--end::Small Box Widget 1-->
              </div>

              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>{{ $totalPin }}</h3>
                    <p>Total Pin</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                  </svg>
                </div>
                <!--end::Small Box Widget 2-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 3-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>{{ $totalPinUsed }}</h3>
                    <p>Total Used Pin</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                  </svg>
                </div>
                <!--end::Small Box Widget 3-->
              </div>
              <!--end::Col-->
            </div>
        <!--end::Row-->
        </div>
        <hr>
        <div class="row">
        <div class="col-md-12 d-flex justify-content-center">

        {{--Multi tier div--}}
        @if(isset($referralUser) && count($referralUser) > 0)
            <div class="tree">
                <ul>
                    <li>
                        <a class="white_color bg-success" href="javascript:void(0)"><h3>{{ auth()->user()->user_name }}</h3></a>
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
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
        <!-- /.container-fluid -->
    </div>
    <!--end::App Content-->
@endsection

@section('js')
<script>
</script>
@endsection
