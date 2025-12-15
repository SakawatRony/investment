<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReferUsersDataTable;
use App\DataTables\UserCommissionDataTable;
use App\DataTables\UserListDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\ReferralUser;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index(UserListDataTable $dataTable)
    {
        if(! checkUserPermission('user', 'view')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

         $data['sidebar'] = 'user';
         $data['sidebar_sub'] = 'users';
         return $dataTable->render('admin.users.index', $data);
    }

    public function create()
    {
        if(! checkUserPermission('user', 'create')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $data['sidebar'] = 'user';
        $data['sidebar_sub'] = 'users_create';
        $data['roles'] = Role::notId()->get();
        return view('admin.users.create', $data);
    }

    public function store(UserRequest $request)
    {
        try {
              DB::beginTransaction();
             $user = User::create($request->all());

        if(!empty($user)) {

            $request['user_id'] = $user->id;
            $useRole = UserRole::create($request->only('user_id', 'role_id'));
             DB::commit();
            return redirect()->route('admin.users')->with('success', actionMessage());
        }
         } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('error', actionMessage('error'));

    }

    public function edit($id)
    {
        if(! checkUserPermission('user', 'update')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $user = User::where('id', $id)->first();

        if (!empty($user)) {
            $data['sidebar'] = 'user';
            $data['sidebar_sub'] = 'users';
            $data['user'] = $user;
            $data['roles'] = Role::notId()->get();
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

            $roleUser = UserRole::where('user_id', $id)->update(['role_id' => $request->role_id]);

            return redirect()->route('admin.users')->with('success', actionMessage('update'));
        }

        return redirect()->back()->with('error', actionMessage('error'));

    }

    public function destroy(Request $request)
    {

        if(! checkUserPermission('user', 'delete')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $user = User::where('id', $request->id)->first();

        $transaction = Transaction::where('user_id', $request->id);

        if($transaction->exists()) {
            return response()->json([
                'status' => 0,
                'message' => actionMessage('failCustom')
            ]);
        }

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

        $users = User::where('user_name', 'like', '%' . $search . '%')->orWhere('phone', 'like', '%' . $search . '%')
            ->notId()
            ->active()
            ->select('id', 'user_name as text')
            ->limit(15)
            ->get();

        return response()->json($users);
    }

    public function commission(UserCommissionDataTable $dataTable, $id)
    {
         $data['sidebar'] = 'user';
         $data['sidebar_sub'] = 'users';

         $data['userData'] = User::where('id', $id)->first();

        if (empty($data['userData'])) {
            return redirect()->back()->with('error', actionMessage('notFound'));
        }

         session()->put('user_commission_id', $id);

         return $dataTable->render('admin.users.commission', $data);
    }

    public function referralUser(ReferUsersDataTable $dataTable, $id)
    {
         $data['sidebar'] = 'user';
         $data['sidebar_sub'] = 'users';

         $data['userData'] = User::where('id', $id)->first();

        if (empty($data['userData'])) {
            return redirect()->back()->with('error', actionMessage('notFound'));
        }

         session()->put('user_refer_id', $id);

         return $dataTable->render('admin.users.referral_user', $data);
    }

    public function showTree($id)
    {
        $data['sidebar'] = 'user';
        $data['sidebar_sub'] = 'users';
        $data['userData'] = User::where('id', $id)->first();

        if (empty($data['userData'])) {
            return redirect()->back()->with('error', actionMessage('notFound'));
        }

        $data['referralUser'] = ReferralUser::where('referral_id', $id)->get();
        return view('admin.users.tree', $data);
    }
}
