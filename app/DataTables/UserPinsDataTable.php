<?php

namespace App\DataTables;

use App\Models\UnitUser;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class UserPinsDataTable  extends DataTable
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
            ->addColumn('created_at', function ($units) {
                return timeZoneformatDate($units->created_at) .'<br>'. timeZonegetTime($units->created_at);
            })
            ->rawColumns(['id', 'user', 'pin', 'unit_name', 'is_used', 'created_at'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $units = UnitUser::where('user_id', auth()->user()->id)->get();
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
            ->parameters([
                'order'      => [0, 'DESC'],
            ]);
    }
}
