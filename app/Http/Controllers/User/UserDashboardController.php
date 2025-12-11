<?php

namespace App\Http\Controllers\User;

use App\DataTables\CommissionDataTable;
use App\DataTables\UserPinsDataTable;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\Commission;
use App\Models\ReferralUser;
use App\Models\UnitUser;
use App\Models\User;
use App\Models\UserCommission;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Auth;
use DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $data['sidebar'] = 'dashboard';
        $data['totalReferral'] = ReferralUser::where('referral_id', auth()->user()->id)->count();
        $data['totalPin'] = UnitUser::where('user_id', auth()->user()->id)->count();
        $data['totalPinUsed'] = UnitUser::where('user_id', auth()->user()->id)->where('is_used', 1)->count();
        $data['referralUser'] = ReferralUser::where('referral_id', auth()->user()->id)->get();
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

    public function signUp()
    {
         $data['sidebar'] = 'sign_up';
        return view('user.sign_up', $data);
    }

    public function signupSubmit(UserRegistrationRequest $request)
    {
            $unitUser = UnitUser::where('pin', $request->pin)->first();

            if(!empty($unitUser) && $unitUser->is_used == 1) {
                return redirect()->back()->with('error', 'This PIN is already in use. Try another one.');
            }

        try {
              DB::beginTransaction();
              $user = User::create($request->all());

        if(!empty($user)) {

            $request['role_id'] = 3;
            $request['user_id'] = $user->id;
            $useRole = UserRole::create($request->only('user_id', 'role_id'));

            if(!empty($unitUser)) {
                $unitUser->is_used = 1;
                $unitUser->save();
                $request['referral_id'] = $unitUser->user_id;
                $request['unit_user_id'] = $unitUser->id;
                $referral = ReferralUser::create($request->only('user_id', 'referral_id', 'unit_user_id'));

                //commission operation
                $commissions = Commission::get();
                foreach($commissions as $commission) {

                    if($commission->slug == 'first') {
                        $request['to_user_id'] = $unitUser->user_id; // receive commssion
                        $request['from_user_id'] = $user->id; ///From which user receive comssion to_user_id
                        $request['from_refer_user_id'] = $unitUser->user_id;
                        $request['commission'] = $commission->value;
                        $commissionUser = UserCommission::create($request->only('to_user_id', 'from_user_id','from_refer_user_id', 'commission'));
                    }

                    if($commission->slug == 'second') {

                        $secondReferralUser = ReferralUser::where('user_id', $unitUser->user_id)->first();

                        if(!empty($secondReferralUser)) {
                            $request['to_user_id'] = $secondReferralUser->referral_id; // receive commssion
                            $request['from_user_id'] = $user->id; //From which user receive comssion to_user_id
                            $request['from_refer_user_id'] = $secondReferralUser->user_id; // Which is been referral for get commission to_user_id
                            $request['commission'] = $commission->value;
                            $commissionUser = UserCommission::create($request->only('to_user_id', 'from_user_id', 'from_refer_user_id', 'commission'));
                        }
                    }

                    if($commission->slug == 'third' && isset($secondReferralUser)) {

                        $thirdReferralUser = ReferralUser::where('user_id', $secondReferralUser->referral_id)->first();

                        if(!empty($thirdReferralUser)) {
                            $request['to_user_id'] = $thirdReferralUser->referral_id;
                            $request['from_user_id'] = $user->id; //which user receive comssion
                            $request['from_refer_user_id'] = $thirdReferralUser->user_id; // Which is been referral for get commission to_user_id
                            $request['commission'] = $commission->value;
                            $commissionUser = UserCommission::create($request->only('to_user_id', 'from_user_id', 'from_refer_user_id', 'commission'));
                        }
                    }
                }

            }

            DB::commit();
            return redirect()->back()->with('success', 'User created successfully!');
        }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

           return redirect()->back()->with('error', 'Something went wrong! Try Again');
    }

    public function changePassword()
    {
        $data['sidebar'] = 'dashboard';
        return view('user.change_password', $data);
    }

    public function changePasswordSubmit(ChangePasswordRequest $request)
    {
        if (User::where('id', Auth::user()->id)->update(['password' => \Hash::make($request->password)])) {
            return redirect()->route('user.dashboard')->with('success', 'Password changed successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong while updating your profile.');
    }

    public function edit()
    {
        $data['sidebar'] = 'dashboard';

         $user = User::where('id', auth()->user()->id)->first();

        if (!empty($user)) {
            $data['user'] = $user;
            return view('user.edit', $data);
        }

        return redirect()->back()->with('error', actionMessage('notFound'));
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        if (!empty($user)) {
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->nid = $request->nid;
            $user->save();

            return redirect()->route('user.dashboard')->with('success', actionMessage('update'));
        }

        return redirect()->back()->with('error', actionMessage('error'));

    }
}
