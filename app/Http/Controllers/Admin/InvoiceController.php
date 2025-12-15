<?php

namespace App\Http\Controllers\admin;

use App\DataTables\ApplicableInvoiceDatTable;
use App\DataTables\InvoiceListDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Balance;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\UserCommission;
use Illuminate\Http\Request;
use DB;

class InvoiceController extends Controller
{
    public function index(ApplicableInvoiceDatTable $dataTable)
    {
        if(! checkUserPermission('applicable_invoice', 'view')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $data['sidebar'] = 'invoice';
        return $dataTable->render('admin.users.applicable_invoice', $data);
    }

    public function invoice(Request $request, $id)
    {

        if(! checkUserPermission('applicable_invoice', 'generate_invoice')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

       $userCommission = UserCommission::where('id', $id)->first();
       $data['sidebar'] = 'generate_invoice';
       try {
            DB::beginTransaction();
            if(!empty($userCommission) && $userCommission->is_invoice == 0) {
                    $data['sidebar'] = 'invoice';
                    $price = $userCommission->unitUser->unit_value * 10;
                    $commission = $userCommission->commission * $price / 100;
                    $commission = $commission;

                    $request['price'] = $price;
                    $request['user_id'] = $userCommission->to_user_id;
                    $request['unit_user_id'] = $userCommission->unit_user_id;
                    $request['commission'] = $commission;
                    $request['params'] = $userCommission->id;
                    $request['type'] = 'invoice';
                    $transaction = Transaction::create($request->all());

                    if(!empty($transaction)) {
                        $userCommission->is_invoice = 1;
                        $userCommission->save();
                        $data['transaction'] = $transaction;

                        $balance = Balance::where('user_id', $userCommission->to_user_id)->first();

                        if(!empty($balance)) {
                            $balance->incrementBalance($commission);
                        } else {
                            $request['amount'] = $commission;
                            Balance::create($request->only('user_id','amount'));
                        }

                        DB::commit();
                        return redirect()->route('admin.user.invoiceView', $transaction->id);
                    }
                } elseif(!empty($userCommission) && $userCommission->is_invoice == 1) {
                    return redirect()->route('admin.user.invoices');
                }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

       return redirect()->back()->with('error', actionMessage('notFound'));
    }

    public function invoiceView($id)
    {
        if(! checkUserPermission('generated_invoice', 'print')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $data['sidebar'] = 'generate_invoice';
        $data['transaction'] = Transaction::where('id', $id)->where('type', 'invoice')->first();
        $data['setting'] = Setting::first();

        if(!empty($data['transaction'])) {

            return view('admin.users.invoice', $data);
        }

         return redirect()->back()->with('error', actionMessage('notFound'));
    }

    public function invoiceList(InvoiceListDataTable $dataTable)
    {

        if(! checkUserPermission('generated_invoice', 'view')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $data['sidebar'] = 'generate_invoice';
        return $dataTable->render('admin.users.generated_invoice', $data);
    }

    public function invoiceWithdrawApprove($id)
    {

        if(! checkUserPermission('generated_invoice', 'withdraw')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $transaction = Transaction::where('id', $id)->where('type', 'invoice')->first();

        if(!empty($transaction) && $transaction->is_withdraw == 1 && $transaction->withdraw_approve == 0 && $transaction->withdraw_reject == 0) {
            $transaction->withdraw_approve  = 1;
            $transaction->save();

            $balance = Balance::where('user_id', $transaction->user_id)->first();
            $balance->decrementBalance($transaction->commission);

            return redirect()->back()->with('success', 'Request successfully approved.');
        }

        return redirect()->back()->with('error', actionMessage('notFound'));
    }

    public function invoiceWithdrawReject($id)
    {

        if(! checkUserPermission('generated_invoice', 'withdraw')) {
            return redirect()->back()->with('error', actionMessage('notPermit'));
        }

        $transaction = Transaction::where('id', $id)->where('type', 'invoice')->first();

        if(!empty($transaction) && $transaction->is_withdraw == 1 && $transaction->withdraw_approve == 0 && $transaction->withdraw_reject == 0) {
            $transaction->withdraw_reject  = 1;
            $transaction->save();

            return redirect()->back()->with('success', 'Request successfully rejected.');
        }

        return redirect()->back()->with('error', actionMessage('notFound'));
    }
}
