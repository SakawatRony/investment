<?php

namespace App\DataTables;
use App\Models\UserCommission;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class ApplicableInvoiceDatTable extends DataTable
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
           ->editColumn('to_user_id', function ($users) {
                return $users->toUser?->user_name . " (".$users->toUser?->phone.")";
            })
           ->editColumn('from_user_id', function ($users) {
                return $users->fromUser?->user_name . " (".$users->fromUser?->phone.")";
            })
            ->editColumn('from_refer_user_id', function ($users) {
                return isset($users->fromReferUser) ? $users->fromReferUser?->user_name . " (".$users->fromReferUser?->phone.")" : "N/A";
            })
            ->addColumn('created_at', function ($users) {
                return timeZoneformatDate($users->created_at) .'<br>'. timeZonegetTime($users->created_at);
            })
            ->addColumn('commission', function ($users) {
                return number_format($users->commission);
            })
            ->addColumn('action', function ($users) {

                $str = '<a data-bs-toggle="tooltip" title="Edit" href="' . route('admin.user.generateInvoice', ['id' => $users->id]) . '" class="btn btn-primary">Generate Invoice</a>';

                return $str;
            })
            ->rawColumns(['id', 'to_user_id', 'from_user_id', 'from_refer_user_id', 'commission', 'action', 'created_at'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $users = UserCommission::where('is_invoice', 0);
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
            ->addColumn(['data' => 'to_user_id', 'name' => 'to_user_id', 'title' => 'Commission User'])
            ->addColumn(['data' => 'from_user_id', 'name' => 'from_user_id', 'title' => 'From User'])
            ->addColumn(['data' => 'from_refer_user_id', 'name' => 'from_refer_user_id', 'title' => 'From Refer'])
            ->addColumn(['data' => 'commission', 'name' => 'commission', 'title' => 'Commission %'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created')])
            ->addColumn([
                'data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '12%',
                'visible' => true,
                'orderable' => false, 'searchable' => false, 'className' => 'text-right align-center',
            ])
            ->parameters([
                'order'      => [0, 'DESC'],
            ]);
    }
}
