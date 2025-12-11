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
        $data['sidebar'] = 'invoice';
        return $dataTable->render('admin.users.applicable_invoice', $data);
    }

    // public function generate($id)
    // {
    //     $userCommission = UserCommission::where('id', $id)->where('is_invoice', 0)->first();

    //     if(!empty($userCommission)) {
    //         $data['sidebar'] = 'invoice';
    //         $data['commission'] = $userCommission;

    //         return view('admin.users.pre_invoice', $data);
    //     }

    //      return redirect()->back()->with('error', actionMessage('notFound'));
    // }

    public function invoice(Request $request, $id)
    {
       $userCommission = UserCommission::where('id', $id)->first();
       $data['sidebar'] = 'generate_invoice';
       try {
            DB::beginTransaction();
            if(!empty($userCommission) && $userCommission->is_invoice == 0) {
                    $data['sidebar'] = 'invoice';
                    $price = $userCommission->unitUser->unit_value * 10;
                    $commission = $userCommission->commission * $price / 100;
                    $commission = round($commission);

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
        $data['sidebar'] = 'generate_invoice';
        return $dataTable->render('admin.users.generated_invoice', $data);
    }
}
