<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $button = '';
        //       $States = State::all();

        $Payments = Payment::with(['Invoice'])->get();
        return view('Pages.Dashboard.Payment.index', compact('Payments'));
    }

    public function get_custom_payment(Request $request)
    {
        $button = '';
        $data = Payment::query();

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
                $button = '<a name="edit" href="' . url("/Dashboard/Payments/$data->id/show") . '" . id="' . $data->id . '" class="edit btn btn-dark btn-sm"><span> <i class="fa fa-eye" aria-hidden="true"></i>عرض</span></a>';
                $button .= '&nbsp;&nbsp;';

                $button = $button . '<a name="edit"  id="' . $data->id . '" payment_value="'.$data->payment_value.'" invoice_id="'.$data->Invoice->id.'" Name_Invoice="'.$data->Invoice->Customer->full_name.'" class="payment btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }

    public function store(Request $request)
    {
        try {

            $Payment = new Payment();
            $Payment->invoice_id = $request->invoice_id;
            $Payment->user_id = $request->user_id;
            $Payment->payment_value = $request->payment_value;
            $Payment->save();

            $Invoice= Invoice::find($request->invoice_id);
            $Remaining=($Invoice->remaining)-($request->payment_value);
            if($Remaining>0){
                $Invoice->update([
                    'remaining' => $Remaining,
                    'Status' => 1

                ]);
            }else{
                $Invoice->update([
                    'remaining' => $Remaining,
                    'Status' => 2

                ]);
            }
            toastr()->success('تمت عملية الاضافة بنجاح');
            return redirect()->route('Invoices.index');
        } catch (\Exception $exception) {
            toastr()->error('لم يتم حفظ البيانات بنجاح');
            return redirect()->route('Invoices.index');

        }

    }
    public function update(Request $request)
    {

            $Payment =Payment::find($request->id);
            $Payment->invoice_id = $request->Invoice_id;
            $Payment->user_id = $request->user_id;
            $Payment->payment_value = $request->payment_value;
            $Payment->save();
            $Invoice= Invoice::find($request->Invoice_id);
            $Remaining=($Invoice->remaining)-($request->payment_value);
            if($Remaining>0){
                $Invoice->update([
                    'remaining' => $Remaining,
                    'Status' => 1

                ]);
            }else{
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
    public function destroy(Request $request){
        try {
            $Payment =Payment::findOrFail ($request->id);
            $Payment->delete();
            toastr()->success('تم عملية الحذف بنجاح');
            return redirect()->route('Payments.index');

        }catch (\Exception $exception){
            toastr()->error('هذا الدفعة غير موجود حاول مرة اخرى');
            return redirect()->route('Payments.index');
        }



    }


}
