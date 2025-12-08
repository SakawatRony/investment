<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
         $data['units'] = Unit::get();
         return view('admin.units.index', $data);
    }

    public function create()
    {
         return view('admin.units.create');
    }

    public function store(Request $request)
    {
        $request['status'] = 'active';

        if(Unit::create($request->all())) {
            return redirect()->route('admin.units')->with('success', 'Unit created successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong! Try Again');
    }

    public function edit($id)
    {
        $unit = Unit::where('id', $id)->first();

        if (!empty($unit)) {

            $data['unit'] = $unit;
            return view('admin.units.edit', $data);
        }

        return redirect()->back()->with('error', 'Unit not found!');
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::where('id', $id)->first();

        if (!empty($unit)) {
            $unit->name = $request->name;
            $unit->params = $request->params;
            $unit->save();

            return redirect()->route('admin.units')->with('success', 'Unit updated successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong!');

    }

    public function destroy(Request $request)
    {
        $unit = Unit::where('id', $request->id)->first();

        if(!empty($unit)) {
            $unit->delete();

            return response()->json([
                'status' => 1
            ]);
        }

        return response()->json([
                'status' => 0
            ]);
    }
}
