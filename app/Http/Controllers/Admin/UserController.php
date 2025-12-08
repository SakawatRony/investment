<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserListDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserListDataTable $dataTable)
    {
         return $dataTable->render('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $request['status'] = 'active';

            if(User::create($request->all())) {
                return redirect()->route('admin.users')->with('success', 'User created successfully!');
            }

            return redirect()->back()->with('error', 'Something went wrong! Try Again');

    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        if (!empty($user)) {
            $data['user'] = $user;
            return view('admin.users.edit', $data);
        }

        return redirect()->back()->with('error', 'User not found!');
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if (!empty($user)) {
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->nid = $request->nid;
            $user->status = $request->status;
            $user->save();

            return redirect()->route('admin.users')->with('success', 'User created successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong!');

    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        if(!empty($user)) {
            $user->delete();

            return response()->json([
                'status' => 1
            ]);
        }

        return response()->json([
                'status' => 0
            ]);
    }
}
