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
            return redirect()->intended(route('dashboard'));
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('user_name', $request->user_name_phone)->orWhere('phone', $request->user_name_phone)->where('status', 'active')->first();

        $request['user_name'] = $request->user_name_phone;
        $request['phone'] = $request->user_name_phone;
        $credentials1 = $request->only('user_name', 'password');
        $credentials2 = $request->only('phone', 'password');
        if (Auth::guard('user')->attempt($credentials1) || Auth::guard('user')->attempt($credentials2)) {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function signUp()
    {
        if(Auth::check()) {
            return redirect()->intended(route('dashboard'));
        }

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

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return redirect()->route('login');

    }
}
