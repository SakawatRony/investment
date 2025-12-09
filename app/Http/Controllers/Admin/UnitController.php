<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\UnitUser;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $data['sidebar'] = 'unit';
        $data['sidebar_sub'] = 'units';
         $data['units'] = Unit::get();
         return view('admin.units.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'unit';
        $data['sidebar_sub'] = 'unit_create';
         return view('admin.units.create', $data);
    }

    public function store(Request $request)
    {
        $request['status'] = 'active';

        if(Unit::create($request->all())) {
            return redirect()->route('admin.units')->with('success', actionMessage());
        }

        return redirect()->back()->with('error', actionMessage('error'));
    }

    public function edit($id)
    {
        $unit = Unit::where('id', $id)->first();

        if (!empty($unit)) {

            $data['sidebar'] = 'unit';
            $data['sidebar_sub'] = 'units';
            $data['unit'] = $unit;
            return view('admin.units.edit', $data);
        }

        return redirect()->back()->with('error', actionMessage('notFound'));
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::where('id', $id)->first();

        if (!empty($unit)) {
            $unit->name = $request->name;
            $unit->params = $request->params;
            $unit->save();

            return redirect()->route('admin.units')->with('success', actionMessage('update'));
        }

        return redirect()->back()->with('error', actionMessage('error'));

    }

    public function destroy(Request $request)
    {
        $unit = Unit::where('id', $request->id)->first();

        if(!empty($unit)) {

            $uniUser = UnitUser::where('unit_id', $unit->id);

            if($uniUser->exists()) {
                return response()->json([
                    'status' => 0,
                    'message' => actionMessage('failCustom'),
                ]);
            }

            $unit->delete();

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
