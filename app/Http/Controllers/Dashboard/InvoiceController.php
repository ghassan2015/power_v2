<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Http\Requests\InvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class InvoiceController extends Controller
{
    public function index(Request $request)
    {

        $button = '';
        //       $States = State::all();

        return view('Pages.Dashboard.Invoices.index');
    }

    public function get_custom_invoice(Request $request)
    {

        $button = '';
        $data = Invoice::query();
        if ($request->input('Customer_id')) {
            $data = $data->where("Customer_id", $request->input('Customer_id'));
        }
        if ($request->input('Month_Invoice')) {
            $data = $data->whereMonth("created_at", $request->input('Month_Invoice'));
        }
        if ($request->input('years')) {
            $data = $data->whereYear("created_at", $request->input('years'));
        }
        if ($request->input('Status')) {
            $data = $data->where("Status", $request->input('Status'));
        }
        return Datatables::of($data)
            ->addColumn('Customer', function ($data) {
                return $data->Customer->full_name;

            }) ->addColumn('k_w_price', function ($data) {
                return $data->Customer->kw_price;
            })->addColumn('Date', function ($data) {
                return $data->created_at->format('Y.m.d');
            })->addColumn('status', function ($data) {

                if ($data->status==0){
                    return 'غير مدفوع';

                }else if ($data->status==1){
                    return ' مدفوع جزئي';

                }else{
                    return ' مدفوع';
                }

            })->addColumn('action', function ($data) {
                $button = '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/show") . '" . id="' . $data->id . '" class="edit btn btn-dark btn-sm"><span> <i class="fa fa-eye" aria-hidden="true"></i>عرض</span></a>';

                $button .= '&nbsp;&nbsp;';
                $button = $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment edit btn btn-warning btn-sm"><span> <i class="fa fa-eye" aria-hidden="true"></i>دفعة</span></a>';
                $button .= '&nbsp;&nbsp;';

                $button = $button . '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="' . $data->id . '" Name_Customer="' . $data->Customer->full_name .'" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }
        public function create(){
        $Customers=Customer::with(['Invoice'])->get();
        return view('Pages.Dashboard.Invoices.create',compact('Customers'));

    }
    public function store(Request $request){

        $data = $request->except('_token');
        $Customer_ids = $data['customer_id'];
        $previous_reading = $data['previous_reading'];
        $current_customer = $data['current_customer'];
        $current_reading = $data['current_reading'];
        $total_kw=$data['total_kw'];
        $Total = $data['Total'];
        try {
            foreach ($Customer_ids as $key => $value) {
                $Invoice = new Invoice();
                $Invoice->customer_id  = $Customer_ids[$key];
                $Invoice->previous_reading = is_null($previous_reading[$key])?$current_customer[$key]:$previous_reading[$key];
                $Invoice->current_reading = $current_reading[$key];
                $Invoice->total_price = $Total[$key];
                $Invoice->total_kw=$total_kw[$key];
                $Invoice->remaining=$Total[$key];
                $Invoice->month=$request->month;
                $Invoice->year=$request->year;
                $Invoice->save();

            }
            toastr()->success('تمت عملية الاضافة بنجاح');

            return redirect()->route('Invoices.index');
        } catch (\Exception $exception) {
            return $exception;
        }

    }
    public function show($id){
        $invoice=Invoice::findorfail($id);
        return view('Pages.Dashboard.Invoices.show',compact('invoice'));

    }
    public function edit($id){
        $invoice=Invoice::findorfail($id);
        return view('Pages.Dashboard.Invoices.edit',compact('invoice'));
    }
        public function update(Request $request,$id){
        try {
            $Invoice=Invoice::findOrFail($id);
            $Invoice->customer_id  = $request->customer_id;
            $Invoice->previous_reading = is_null($request->previous_reading)?$request->current_customer:$request->previous_reading;
            $Invoice->current_reading = $request->current_reading;
            $Invoice->total_price = $request->Total;
            $Invoice->total_kw=$request->total_kw;
            $Invoice->remaining=$request->Total;
            $Invoice->month=$request->month;
            $Invoice->year=$request->year;
            $Invoice->save();
            toastr()->success('تمت عملية التعديل بنجاح');
            return redirect()->route('Invoices.index');
        }catch (\Exception $ex){
            return $ex;
            toastr()->error('لم يتم الاضافة هناك خلل ما يرجى المحاولة لاحقا');
            return redirect()->route('Invoices.index');

        }






    }
    public function destroy(Request $request)
    {
        try {
            $Payment_id = Payment::where('invoice_id', $request->id)->pluck('invoice_id');
            if ($Payment_id->count() == 0) {
                \App\Models\Invoice::findOrFail($request->id)->delete();
                toastr()->success('تمت عملية التعديل بنجاح');
            } else {
                toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح بسبب وجود ابناء له');

            }
            return redirect()->back();

        } catch (\Exception $exception) {
            toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح');
            return redirect()->route('Invoices.index');

        }


    }

    public function getInvoice($id){
        $invoice=Invoice::where('Customer_id',$id)->latest()->get();
        return $invoice;
    }
}
