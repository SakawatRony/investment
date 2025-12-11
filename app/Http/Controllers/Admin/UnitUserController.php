<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UnitUserListDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitUserRequest;
use App\Models\UnitUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UnitUserController extends Controller
{
    public function index(UnitUserListDataTable $dataTable)
    {
         $data['sidebar'] = 'unit';
         $data['sidebar_sub'] = 'unit_users';
         return $dataTable->render('admin.unit_user.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'unit';
        $data['sidebar_sub'] = 'unit_users_create';
        return view('admin.unit_user.create', $data);
    }

    public function store(UnitUserRequest $request)
    {
        $count = 0;
        for($i = 1; $i <= $request->total_number; $i++) {

            $pin = Str::random(6);

            do {
                $pin = Str::random(6);
            } while (UnitUser::where('pin', $pin)->exists());

            $request['unit_name'] = $request->unit_value." P";
            $request['pin'] = $pin;

            UnitUser::create($request->all());
        }

        return redirect()->route('admin.units.user')->with('success', actionMessage('success'));
    }

    public function destroy(Request $request)
    {
        $unitUser = UnitUser::where('id', $request->id)->first();

        if(!empty($unitUser) && $unitUser->is_used == 0) {
            $unitUser->delete();

            return response()->json([
                'status' => 1,
                'message' => actionMessage('delete'),
            ]);
        }

        return response()->json([
                'status' => 0,
                'message' => actionMessage('error'),
            ]);
    }
}
