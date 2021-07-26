<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {



        return view('Pages.Customers.Payment.index');
    }

    public function get_custom_payment(Request $request)

    {
        $button = '';
        $Customer = auth('customer')->user()->id;
        $invoices = Invoice::query();

      $invoices_id=  $invoices->where('customer_id',$Customer)->pluck('id');

        $data = Payment::query();
        $data->where('customer_id',$Customer);

        if ($request->input('Invoice_id')) {
            $data = $data->where("invoice_id", $request->input('Invoice_id'));
        }
        if ($request->input('Month_Payment')) {
            $data = $data->whereMonth("created_at", $request->input('Month_Payment'));
        }
        if ($request->input('Status')) {
            $data->whereHas('Invoice', function($q) use($request){
                $q->where("status", $request->input('Status'));
            });
//            $data = $data->Invoice->where("status", $request->input('Status'));
        }
        if ($request->input('Years_Payment')) {

            $data = $data->whereYear("created_at", $request->input('Years_Payment'));
        }

        return DataTables::of($data)
            ->addColumn('Customer', function ($data) {
                return $data->Invoice->Customer->full_name;

            })->addColumn('Invoice_Total_Price', function ($data) {
                return $data->Invoice->total_price;
            })
            ->addColumn('payment', function ($data) {

                return $data->payment_value;

            })
            ->addColumn('Date', function ($data) {
                return $data->Invoice->created_at->format('Y.m.d');
            })->addColumn('status', function ($data) {

                if ($data->Invoice->status == 0) {
                    return 'غير مدفوع';

                } else if ($data->Invoice->status == 1) {
                    return ' مدفوع جزئي';

                } else {
                    return ' مدفوع';
                }

            })->addColumn('action', function ($data) {
                $button = '<a name="edit" href="' . url("/Customers/Payments/$data->id/show") . '" . id="' . $data->id . '" class="edit btn btn-dark btn-sm"><span> <i class="fa fa-eye" aria-hidden="true"></i>عرض</span></a>';
                $button .= '&nbsp;&nbsp;';

                $button = $button . '<a name="edit"  id="' . $data->id . '" payment_value="'.$data->payment_value.'" invoice_id="'.$data->Invoice->id.'" Name_Invoice="'.$data->Invoice->Customer->full_name.'" class="payment btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }
    public function show($id)
    {

        $payment = Payment::findOrFail($id);
        return view('Pages.Customers.Payment.show', compact('payment'));

}
}



