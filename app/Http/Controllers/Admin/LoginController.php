<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return $this->redirectRole();
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('user_name', $request->user_name_phone)->orWhere('phone', $request->user_name_phone)->first();

        if(!empty($user) && $user->status != 'active') {
            return redirect()->back()->with('error', 'Inactive user!');
        }

        $request['user_name'] = $request->user_name_phone;
        $request['phone'] = $request->user_name_phone;
        $credentials1 = $request->only('user_name', 'password');
        $credentials2 = $request->only('phone', 'password');

        if (Auth::guard('user')->attempt($credentials1) || Auth::guard('user')->attempt($credentials2)) {

            return $this->redirectRole();

        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function redirectRole()
    {
        if(auth()->user()->roleUser?->role_id == '1' || auth()->user()->roleUser?->role_id == '2') {
                return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->intended(route('user.dashboard'));
        }
    }

    public function signUp()
    {
        if(Auth::check()) {
            return $this->redirectRole();
        }

        return view('admin.auth.registration');
    }

    public function register(UserRegistrationRequest $request)
    {
            $request['status'] = 'active';
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
                $referral = ReferralUser::create($request->only('user_id', 'referral_id'));

                //commission operation
                $commissions = Commission::get();
                foreach($commissions as $commission) {

                    if($commission->slug == 'first') {
                        $request['to_user_id'] = $unitUser->user_id; // receive commssion
                        $request['from_user_id'] = $user->id; ///From which user receive comssion to_user_id
                        $request['from_refer_user_id'] = $unitUser->user_id;
                        $request['unit_user_id'] = $unitUser->id;
                        $request['commission'] = $commission->value;
                        $commissionUser = UserCommission::create($request->only('to_user_id', 'from_user_id','from_refer_user_id', 'unit_user_id', 'commission'));
                    }

                    if($commission->slug == 'second') {

                        $secondReferralUser = ReferralUser::where('user_id', $unitUser->user_id)->first();

                        if(!empty($secondReferralUser)) {
                            $request['to_user_id'] = $secondReferralUser->referral_id; // receive commssion
                            $request['from_user_id'] = $user->id; //From which user receive comssion to_user_id
                            $request['from_refer_user_id'] = $secondReferralUser->user_id; // Which is been referral for get commission to_user_id
                            $request['unit_user_id'] = $unitUser->id;
                            $request['commission'] = $commission->value;
                            $commissionUser = UserCommission::create($request->only('to_user_id', 'from_user_id', 'from_refer_user_id', 'unit_user_id', 'commission'));
                        }
                    }

                    if($commission->slug == 'third' && isset($secondReferralUser)) {

                        $thirdReferralUser = ReferralUser::where('user_id', $secondReferralUser->referral_id)->first();

                        if(!empty($thirdReferralUser)) {
                            $request['to_user_id'] = $thirdReferralUser->referral_id;
                            $request['from_user_id'] = $user->id; //which user receive comssion
                            $request['from_refer_user_id'] = $thirdReferralUser->user_id; // Which is been referral for get commission to_user_id
                            $request['unit_user_id'] = $unitUser->id;
                            $request['commission'] = $commission->value;
                            $commissionUser = UserCommission::create($request->only('to_user_id', 'from_user_id', 'from_refer_user_id', 'unit_user_id', 'commission'));
                        }
                    }
                }

            }

            DB::commit();
            return redirect()->route('login')->with('success', 'User created successfully!');
        }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

           return redirect()->back()->with('error', 'Something went wrong! Try Again');
    }

    public function authCheck()
    {
        if(Auth::check()) {
            return $this->redirectRole();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return redirect()->route('login');

    }
}
