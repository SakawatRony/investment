<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function register(Request $request)
    {
        if($request->isMethod('post')) {
            dd($request->all());
        } else {
            return view('admin.auth.registration');
        }
    }
}
