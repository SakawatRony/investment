<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserListDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserListDataTable $dataTable)
    {
         return $dataTable->render('admin.users.index');
    }
}
