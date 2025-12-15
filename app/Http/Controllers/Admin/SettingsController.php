<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function companyDetails()
    {
        if(auth()->user()->roleUser?->role_id != '1' && auth()->user()->roleUser?->role_id != '2') {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $data['sidebar'] = 'settings';
        $data['sidebar_sub'] = 'company';
        $data['settings'] = Setting::first();

        return view('admin.settings.company_details', $data);
    }

    public function companyDetailsUpdate(Request $request)
    {
        Setting::where('id', 1)->update(['company_name' => $request->company_name, 'address'=> $request->address, 'phone'=>$request->phone]);
        Cache::forget('settings');

        return redirect()->back()->with('success', actionMessage('update'));
    }

    public function permission()
    {
        if(auth()->user()->roleUser?->role_id != '1' && auth()->user()->roleUser?->role_id != '2') {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $data['sidebar'] = 'settings';
        $data['sidebar_sub'] = 'permission';
        $data['roles'] = Role::whereNotIn('id', [1,2,3])->get();
        return view('admin.settings.permission_role', $data);
    }


    public function checkPermission($id)
    {
        if(auth()->user()->roleUser?->role_id != '1' && auth()->user()->roleUser?->role_id != '2') {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $data['sidebar'] = 'settings';
        $data['sidebar_sub'] = 'permission';
        $data['roles'] = Role::where('id', $id)->whereNotIn('id', [1,2,3])->first();
        return view('admin.settings.permission', $data);
    }

    public function permissionUpdate(Request $request, $id)
    {
        if(auth()->user()->roleUser?->role_id != '1' && auth()->user()->roleUser?->role_id != '2') {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

         Role::where('id', $id)->update(['permissions' => json_encode($request->except('_token'))]);
         return redirect()->back()->with('success', actionMessage('update'));
    }
}
