<?php

namespace App\Http\Controllers\Dashboard;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Exports\PaymentExecl;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $button = '';
        //       $States = State::all();
        $Customers=Customer::all();
        return view('Pages.Dashboard.Payment.index', compact('Customers'));
    }

    public function get_custom_payment(Request $request)
    {

        $button = '';
        $data = Payment::query();

        if ($request->input('Customer_id')) {
            $data->whereHas('Invoice', function ($q) use ($request) {
                $q->where("customer_id", $request->input('Customer_id'));
            });
        }
        if ($request->input('Month_Payment')) {
            $data = $data->whereMonth("created_at", $request->input('Month_Payment'));
        }
        if ($request->input('Years_Payment')) {
            $data = $data->whereYear("created_at", $request->input('Years_Payment'));
        }
        if ($request->input('Status')) {
            $data->whereHas('Invoice', function ($q) use ($request) {
                $q->where("status", $request->input('Status'));
            });
//            $data = $data->Invoice->where("status", $request->input('Status'));
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
                $button = '<a name="edit" href="' . url("/Dashboard/Payments/$data->id/show") . '" . id="' . $data->id . '" ><span> <i class="fa fa-eye" aria-hidden="true"></i></span></a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button = $button . '<a name="edit"  id="' . $data->id . '" payment_value="' . $data->payment_value . '" month="'.$data->month.'" year="'.$data->year.'"invoice_id="' . $data->Invoice->id . '" Name_Invoice="' . $data->Invoice->Customer->full_name . '" class="payment"><span><i class="fas fa-edit"></i></span></a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a type="button" name="delete"  Name_Delete="'.$data->no_payment.'"id="' . $data->id . '" class="delete"><span><i class="fas fa-trash-alt"></i></span></a>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }

    public function store(Request $request)
    {


        try {
            $Invoice_Payment = Invoice::find($request->invoice_id);
            $remain = $Invoice_Payment->remaining;
            if ($remain >= $request->payment_value) {
                $Payment = new Payment();
                $Payment->no_payment = $request->payment_no;
                $Payment->invoice_id = $request->invoice_id;
                $Payment->month = $request->month;
                $Payment->year = $request->year;

                $Payment->user_id = $request->user_id;
                $Payment->payment_value = $request->payment_value;
                $Payment->save();
                $Invoice = Invoice::find($request->invoice_id);
                $Remaining = ($Invoice->remaining) - ($request->payment_value);
                if ($Remaining > 0) {
                    $Invoice->update([
                        'remaining' => $Remaining,
                        'Status' => 1

                    ]);
                } else {
                    $Invoice->update([
                        'remaining' => $Remaining,
                        'Status' => 2

                    ]);
                }
                toastr()->success('تمت عملية الاضافة بنجاح');
            } else {
                toastr()->error('قيمة الدفعة كبير من المبلغ المستحق');

            }
            return redirect()->route('Invoices.index');
        } catch (\Exception $exception) {
            toastr()->error('لم يتم حفظ البيانات بنجاح');
            return redirect()->route('Invoices.index');

        }

    }

    public function update(Request $request)
    {

        $Payment = Payment::find($request->id);
        $Payment->invoice_id = $request->Invoice_id;
        $Payment->month = $request->month;
        $Payment->year = $request->year;
        $Payment->user_id = $request->user_id;
        $Payment->payment_value = $request->payment_value;
        $Payment->save();
        $Invoice = Invoice::find($request->Invoice_id);
        $Remaining = ($Invoice->remaining) - ($request->payment_value);
        if ($Remaining > 0) {
            $Invoice->update([
                'remaining' => $Remaining,
                'Status' => 1

            ]);
        } else {
            $Invoice->update([
                'remaining' => $Remaining,
                'Status' => 2

            ]);
        }

        toastr()->success('تمت عملية التعديل بنجاح');

        return redirect()->route('Payments.index');


    }

    public function show($id)
    {
        $Payment = Payment::with('Invoice')->findOrFail($id);
        if (!$Payment) {
            toastr()->error('هذا الدفعة غير موجود حاول مرة اخرى');
            return redirect()->route('Payments.index');
        }
        return view('Pages.Dashboard.Payment.show', compact('Payment'));

    }

    public function destroy(Request $request)
    {
        try {
            $Payment = Payment::findOrFail($request->id);
            $Payment->delete();
            toastr()->success('تم عملية الحذف بنجاح');
            return redirect()->route('Payments.index');

        }catch (\Exception $exception) {
            toastr()->error('هذا الدفعة غير موجود حاول مرة اخرى');
            return redirect()->route('Payments.index');
        }


    }

    public function print_Payment(Request $request)
    {
     $customer_id = Invoice::where('customer_id',$request->Customer_id)->pluck('id')->toarray();
     $Status= Invoice::where('status',$request->Status)->pluck('id')->toarray();

        $data = Payment::orwhereIn('invoice_id', $customer_id)
            ->orwhere('month', $request->input('Month_Payment'))
            ->orwhere('year', $request->input('Years_Payment'))
            -> orwhereIn('invoice_id', $Status)
             ->get();

        if($data->count()==0) {
            $data = Payment::get();

        }
        $history=Carbon::now()->format('Y-m-d');
        $day=Hijri::Date('l');

            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
        $mpdf->SetWatermarkImage('assets/media/logos/logo.png');
        $mpdf->showWatermarkImage = true;

        $mpdf->WriteHTML(view('Pages.Dashboard.Payment.pdf', compact('data','day','history'))->render());
            $mpdf->Output('كشف الدفعات' . ' ' . ' ' . $request->month . '.pdf', 'I');
        }
    public function excel(Request $request){
        return \Maatwebsite\Excel\Facades\Excel::download(new PaymentExecl($request), 'Payment.xlsx');
    }


}
