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
         $data['sidebar'] = 'user';
         $data['sidebar_sub'] = 'users';
         return $dataTable->render('admin.users.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'user';
        $data['sidebar_sub'] = 'users_create';
        return view('admin.users.create', $data);
    }

    public function store(UserRequest $request)
    {
        $request['status'] = 'active';

            if(User::create($request->all())) {
                return redirect()->route('admin.users')->with('success', actionMessage());
            }

            return redirect()->back()->with('error', actionMessage('error'));

    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        if (!empty($user)) {
            $data['sidebar'] = 'user';
            $data['sidebar_sub'] = 'users';
            $data['user'] = $user;
            return view('admin.users.edit', $data);
        }

        return redirect()->back()->with('error', actionMessage('notFound'));
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

            return redirect()->route('admin.users')->with('success', actionMessage('update'));
        }

        return redirect()->back()->with('error', actionMessage('error'));

    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        if(!empty($user)) {
            $user->delete();

            return response()->json([
                'status' => 1,
                'message' => actionMessage('delete')
            ]);
        }

        return response()->json([
                'status' => 0,
                'message' => actionMessage('error')
            ]);
    }

    public function search(Request $request)
    {
        $search = $request->q;

        $users = User::where('user_name', 'like', '%' . $search . '%')
            ->notId()
            ->active()
            ->select('id', 'user_name as text')
            ->limit(15)
            ->get();

        return response()->json($users);
    }
}
