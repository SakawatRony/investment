<ul>
    @foreach($grandChilds as $grand)
        <li><a href="javascript:void(0)">{{ $grand->refer?->user_name }}</a>
            @php
                $grandChilds = App\Models\ReferralUser::where('referral_id', $grand->user_id)->get()
            @endphp
            @if(!empty($grandChilds) && count($grandChilds) > 0)
                @include('user.child', ['grandChilds' => $grandChilds])
            @endif
        </li>
    @endforeach
</ul>
