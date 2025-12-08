<?php

namespace App\DataTables;

use App\Models\Unit;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class UnitListDataTable extends DataTable
{
    /*
    * DataTable Ajax
    *
    * @return \Yajra\DataTables\DataTableAbstract|\Yajra\DataTables\DataTables
    */
    public function ajax(): JsonResponse
    {
        $users = $this->query();
        return datatables()
           ->of($users)
           ->editColumn('status', function ($users) {
                return $users->status;
            })
            ->addColumn('action', function ($users) {

                $edit = '<a data-bs-toggle="tooltip" title="Edit" href="' . route('admin.users.edit', ['id' => $users->id]) . '" class="btn btn-primary"><i class="bi bi-arrow-right-square"></i></a>';

                $str = '';
                $str .= $edit;
                $str .= '<a data-bs-toggle="tooltip" title="Delete" href="javascript:void(0)" class="delete btn btn-danger" data-id="'.$users->id.'" data-toggle="modal" data-target="#delete_modal"><i class="bi bi-archive-fill"></i></a>';

                return $str;
            })
            ->addColumn('created_at', function ($users) {
                return timeZoneformatDate($users->created_at) .'<br>'. timeZonegetTime($users->created_at);
            })
            ->rawColumns(['id', 'full_name', 'user_name', 'phone', 'email', 'nid', 'status', 'action', 'created_at'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $units= Unit::get();
        return $this->applyScopes($units);
    }

    /*
    * DataTable HTML
    *
    * @return \Yajra\DataTables\Html\Builder
    */
    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'Id', 'visible' => false])
            ->addColumn(['data' => 'full_name', 'name' => 'full_name', 'title' => 'Full Name'])
            ->addColumn(['data' => 'user_name', 'name' => 'user_name', 'title' => 'User Name'])
            ->addColumn(['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => __('Email')])
            ->addColumn(['data' => 'nid', 'name' => 'nid', 'title' => __('NID'), 'orderable' => false])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created')])
            ->addColumn([
                'data' => 'action', 'name' => 'action', 'title' => '', 'width' => '12%',
                'visible' => true,
                'orderable' => false, 'searchable' => false, 'className' => 'text-right align-center',
            ])
            ->parameters([
                'order'      => [0, 'DESC'],
            ]);
    }
}
