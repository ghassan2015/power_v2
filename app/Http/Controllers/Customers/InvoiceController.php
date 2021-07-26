<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index()
    {


        return view('Pages.Customers.Invoice.index');
    }

    public function get_custom_invoice(Request $request)
    {

        $Customer = auth('customer')->user()->id;

          $counter=Invoice::where('customer_id', $Customer)->get();


        if ($request->input('Customer_id')) {
            $counter = $counter->where("Customer_id", $request->input('Customer_id'));
        }
        if ($request->input('Month_Invoice')) {
            $counter = $counter->whereMonth("created_at", $request->input('Month_Invoice'));
        }
        if ($request->input('years')) {
            $counter = $counter->whereYear("created_at", $request->input('years'));
        }
        if ($request->input('Status')) {
            $counter = $counter->where("Status", $request->input('Status'));
        }
        return Datatables::of($counter)
            ->addColumn('ids', function ($counter) {

            return    $counter->count();
            })
            ->addColumn('Customer', function ($counter) {
                return $counter->Customer->full_name;

            })->addColumn('k_w_price', function ($counter) {
                return $counter->Customer->kw_price;
            })->addColumn('Date', function ($counter) {
                return $counter->created_at->format('Y.m.d');
            })->addColumn('status', function ($counter) {

                if ($counter->status==0){
                    return 'غير مدفوع';

                }else if ($counter->status==1){
                    return 'مدفوع جزئي';

                }else if($counter->status==2){

                    return 'مدفوع';
                }
            })->addColumn('action', function ($counter) {
                $button = '<a name="edit" href="' . url("/Customers/Invoices/$counter->id/show") . '"  id="' . $counter->id . '" ><span> <i class="fa fa-eye" aria-hidden="true"></i></span></a>';
                $button .= '&nbsp;&nbsp;';


                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }

    public function show($id)
    {
        $invoice = Invoice::findorfail($id);
        $Payments=Payment::where('invoice_id',$invoice->id)->get();
        return view('Pages.Customers.Invoice.show', compact('Payments','invoice'));

    }

    public function showPayment($id)
    {


         $Invoice = Invoice::with(['Payment'])->find($id);

        if (!$Invoice) {
            toastr()->error('هذا الدفعة غير موجود حاول مرة اخرى');
            return redirect()->route('Payments.index');
        }
        return view('Pages.Customers.Payment.show', compact('Invoice'));

    }
}


