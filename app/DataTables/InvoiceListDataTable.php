<?php

namespace App\DataTables;
use App\Models\Transaction;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\JsonResponse;

class InvoiceListDataTable extends DataTable
{
  /*
    * DataTable Ajax
    *
    * @return \Yajra\DataTables\DataTableAbstract|\Yajra\DataTables\DataTables
    */
    public function ajax(): JsonResponse
    {
        $transactions = $this->query();
        return datatables()
           ->of($transactions)
           ->editColumn('user_id', function ($transactions) {
                return $transactions->user?->user_name . " (".$transactions->user?->phone.")";
            })
            ->editColumn('unit_user_id', function ($transactions) {
                return $transactions->unitUser?->unit_name;
            })
            ->editColumn('params', function ($transactions) {
                return $transactions->userCommission?->commission;
            })
            ->addColumn('created_at', function ($transactions) {
                return timeZoneformatDate($transactions->created_at) .'<br>'. timeZonegetTime($transactions->created_at);
            })
            ->addColumn('action', function ($transactions) {

                $str = '<a data-bs-toggle="tooltip" title="Edit" href="' . route('admin.user.invoiceView', ['id' => $transactions->id]) . '" class="btn btn-primary">View</a>';

                if($transactions->is_withdraw == 1 && $transactions->withdraw_approve == 0 && $transactions->withdraw_reject == 0) {
                    $str .= '&nbsp;<a data-bs-toggle="tooltip" title="Click for withdraw request approve" href="' . route('admin.invoiceWithdrawApprove', ['id' => $transactions->id]) . '" onclick="return confirm(\'Are you sure you want to approve?\')" class="btn btn-warning">Approve?</a>';
                    $str .= '&nbsp;<a data-bs-toggle="tooltip" title="Click for withdraw request reject" href="' . route('admin.invoiceWithdrawReject', ['id' => $transactions->id]) . '" onclick="return confirm(\'Are you sure you want to reject?\')" class="btn btn-danger">Reject?</a>';
                } elseif($transactions->is_withdraw == 1 && $transactions->withdraw_approve == 1 && $transactions->withdraw_reject == 0) {
                    $str .= '&nbsp;<a data-bs-toggle="tooltip" title="Already approved" href=javascript:void(0) class="btn btn-success">Approved</a>';
                } elseif($transactions->is_withdraw == 1 && $transactions->withdraw_approve == 0 && $transactions->withdraw_reject == 1) {
                    $str .= '&nbsp;<a data-bs-toggle="tooltip" title="Rejected" href=javascript:void(0) class="btn btn-danger">Rejected</a>';
                } elseif($transactions->is_withdraw == 0 && $transactions->withdraw_approve == 0 && $transactions->withdraw_reject == 0) {
                    $str .= '&nbsp;<a data-bs-toggle="tooltip" title="Available for withdraw" href=javascript:void(0) class="btn btn-primary">Available</a>';
                }

                return $str;
            })
            ->rawColumns(['id', 'user_id', 'unit_user_id', 'params', 'commission', 'created_at', 'action', 'price'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        $transactions = Transaction::where('type', 'invoice');
        return $this->applyScopes($transactions);
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
            ->addColumn(['data' => 'unit_user_id', 'name' => 'unit_user_id', 'title' => 'Unit'])
            ->addColumn(['data' => 'params', 'name' => 'params', 'title' => 'Commission %'])
            ->addColumn(['data' => 'price', 'name' => 'price', 'title' => 'Point Value'])
            ->addColumn(['data' => 'commission', 'name' => 'commission', 'title' => 'Commission'])
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
