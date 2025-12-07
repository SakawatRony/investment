<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect()->intended(route('admin.dashboard'));
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
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function signUp()
    {
        $this->authCheck();
        return view('admin.auth.registration');
    }

    public function register(UserRequest $request)
    {
            $request['status'] = 'active';
            if(User::create($request->all())) {
                return redirect()->route('login')->with('success', 'User created successfully!');
            }

            return redirect()->back()->with('error', 'Something went wrong while updating your profile.');
    }

    public function authCheck()
    {
        if(Auth::check()) {
            return redirect()->intended(route('admin.dashboard'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return redirect()->route('login');

    }
}
