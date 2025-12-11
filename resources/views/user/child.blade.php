<ul>
    @foreach($grandChilds as $grand)
        <li><a class="white_color bg-warning"  href="javascript:void(0)" title="{{ $grand->unitUser?->unit_name }}"><h3>{{ $grand->refer?->user_name }}</h3></a>
            @php
                $grandChilds = App\Models\ReferralUser::where('referral_id', $grand->user_id)->get();
            @endphp
            @if(!empty($grandChilds) && count($grandChilds) > 0)
                @include('user.child', ['grandChilds' => $grandChilds, 'count' => $count])
            @endif
        </li>
    @endforeach
</ul>
