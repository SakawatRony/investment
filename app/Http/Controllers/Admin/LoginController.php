<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('user_name', $request->user_name_phone)->orWhere('phone', $request->user_name_phone)->first();
//dd($user);
        if(!empty($user) && \Hash::check($request->password, $user->password)) {
            return view('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function signUp()
    {
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
}
