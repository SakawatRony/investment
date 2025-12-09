<?php

namespace App\Http\Controllers\User;

use App\DataTables\CommissionDataTable;
use App\DataTables\UserPinsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ReferralUser;
use App\Models\UnitUser;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $data['sidebar'] = 'dashboard';
        $data['totalReferral'] = ReferralUser::where('referral_id', auth()->user()->id)->count();
        $data['totalPin'] = UnitUser::where('user_id', auth()->user()->id)->count();
        $data['totalPinUsed'] = UnitUser::where('user_id', auth()->user()->id)->where('is_used', 1)->count();
        return view('user.dashboard', $data);
    }

    public function unit(UserPinsDataTable $dataTable)
    {
        $data['sidebar'] = 'unit';
        return $dataTable->render('user.unit_user.index', $data);
    }

    public function commission(CommissionDataTable $dataTable)
    {
        $data['sidebar'] = 'commission';
        return $dataTable->render('user.unit_user.commission', $data);
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return redirect()->route('login');

    }
}
