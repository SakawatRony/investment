<?php

namespace App\DataTables;
use App\Models\UserCommission;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class CommissionDataTable extends DataTable
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
           ->editColumn('from_user_id', function ($users) {
                return $users->fromUser?->user_name . " (".$users->fromUser?->phone.")";
            })
            ->editColumn('from_refer_user_id', function ($users) {
                return isset($users->fromReferUser) ? $users->fromReferUser?->user_name . " (".$users->fromReferUser?->phone.")" : "N/A";
            })
            ->addColumn('created_at', function ($users) {
                return timeZoneformatDate($users->created_at) .'<br>'. timeZonegetTime($users->created_at);
            })
            ->rawColumns(['id', 'from_user_id', 'from_refer_user_id', 'created_at'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $users = UserCommission::where('to_user_id', auth()->user()->id);
        session()->forget('user_commission_id');
        return $this->applyScopes($users);
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
            ->addColumn(['data' => 'from_user_id', 'name' => 'from_user_id', 'title' => 'From User'])
            ->addColumn(['data' => 'from_refer_user_id', 'name' => 'from_refer_user_id', 'title' => 'From Referral'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created')])
            ->parameters([
                'order'      => [0, 'DESC'],
            ]);
    }
}
