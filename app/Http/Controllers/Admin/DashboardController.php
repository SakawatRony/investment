<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['sidebar'] = 'dashboard';
        return view('admin.dashboard', $data);
    }

    public function changePassword()
    {
        $data['sidebar'] = 'dashboard';
        return view('admin.change_password', $data);
    }

    public function changePasswordSubmit(ChangePasswordRequest $request)
    {
        if (User::where('id', Auth::user()->id)->update(['password' => \Hash::make($request->password)])) {
            return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong while updating your profile.');
    }
}
