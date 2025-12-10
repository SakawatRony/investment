<?php

namespace App\DataTables;

use App\Models\UnitUser;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class UnitUserListDataTable extends DataTable
{
    /*
    * DataTable Ajax
    *
    * @return \Yajra\DataTables\DataTableAbstract|\Yajra\DataTables\DataTables
    */
    public function ajax(): JsonResponse
    {
        $units = $this->query();
        return datatables()
           ->of($units)
           ->addColumn('user', function ($units) {
                return $units->user?->full_name;
            })
            ->addColumn('unit_name', function ($units) {
                return $units->unit_name;
            })
            ->addColumn('is_used', function ($units) {
                return $units->is_used == 1 ? 'Used' : 'Not Used';
            })
            ->addColumn('action', function ($units) {

                $str = '';

                if($units->is_used != 1) {
                    $str .= '<a data-bs-toggle="tooltip" title="Delete" href="javascript:void(0)" class="delete btn btn-danger" data-id="'.$units->id.'" data-toggle="modal" data-target="#delete_modal"><i class="bi bi-archive-fill"></i></a>';
                } else {
                    $str = 'N/A';
                }

                return $str;
            })
            ->addColumn('created_at', function ($units) {
                return timeZoneformatDate($units->created_at) .'<br>'. timeZonegetTime($units->created_at);
            })
            ->rawColumns(['id', 'user', 'pin', 'unit_name', 'action', 'is_used', 'created_at'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $units = UnitUser::get();
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
            ->addColumn(['data' => 'user', 'name' => 'user', 'title' => 'User'])
            ->addColumn(['data' => 'unit_name', 'name' => 'unit_name', 'title' => 'Unit'])
            ->addColumn(['data' => 'pin', 'name' => 'pin', 'title' => 'Pin'])
            ->addColumn(['data' => 'is_used', 'name' => 'is_used', 'title' => 'Is Used'])
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
