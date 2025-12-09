<?php

namespace App\DataTables;

use App\Models\ReferralUser;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class ReferUsersDataTable extends DataTable
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
           ->editColumn('user_id', function ($users) {
                return $users->user?->user_name . " (".$users->user?->phone.")";
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
        $users = ReferralUser::where('referral_id', session()->get('user_refer_id'));
        session()->forget('user_refer_id');
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
            ->addColumn(['data' => 'user_id', 'name' => 'user_id', 'title' => 'User'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created')])
            ->parameters([
                'order'      => [0, 'DESC'],
            ]);
    }
}
