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
}
