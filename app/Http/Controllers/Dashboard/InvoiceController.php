<?php

namespace App\Http\Controllers\Dashboard;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Exports\InvoiceExport;
use App\Http\Controllers\Controller;

use App\Http\Requests\InvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {

        $Customers=Customer::all();

        return view('Pages.Dashboard.Invoices.index',compact('Customers'));
    }

    public function get_custom_invoice(Request $request)
    {

        $button = '';

        $data = Invoice::query();
        if ($request->input('Customer_id')) {
            $data = $data->where("Customer_id", $request->input('Customer_id'));
        }
        if ($request->input('Month_Invoice')) {
            $data = $data->where("month", $request->input('Month_Invoice'));
        }
        if ($request->input('years')) {
            $data = $data->where("year", $request->input('years'));
        }
        if ($request->input('Status')) {
            $data = $data->where("status", $request->input('Status'));
        }
        return Datatables::of($data)
            ->addColumn('Customer', function ($data) {
                return $data->Customer->full_name;

            }) ->addColumn('reminder', function ($data) {
                return '<input type="checkbox">';

            })->addColumn('k_w_price', function ($data) {
                return $data->Customer->kw_price;
            })->addColumn('Date', function ($data) {
                return ($data->year).'-'.($data->month);

            })->addColumn('Remaining', function ($data) {
                return $data->remaining;
            })

            ->addColumn('status', function ($data) {

                if ($data->status == 0) {
                    return 'غير مدفوع';

                } else if ($data->status == 1) {
                    return 'مدفوع جزئي';

                } else if ($data->status == 2) {

                    return 'مدفوع';
                }

            })->addColumn('action', function ($data) {
                $button = '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/show") . '" . id="' . $data->id . '"><span> <i class="icon-x far fa-eye" aria-hidden="true"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button =  $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment"><span> <i class="icon-x fab fa-cc-apple-pay"></i></span></a>';
//                $button = $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment"><span> <i class="fa fa-eye" aria-hidden="true"></i>دفعة</span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button = $button . '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/edit") . '" . id="' . $data->id . '" ><span><i class="icon-x fas fa-edit"></i></span></a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a type="button" name="delete" id="' . $data->id . '" Name_Customer="' . $data->Customer->full_name .'" class="delete"><span><i class="icon-x1 text-dark-50 flaticon-delete-1"></i></span></a>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }
    public function create(Request $request){

        $year='';
        $month='';
            $year = $request->year;
            $month = $request->month;

            if(is_null($request->month)) {
                $month = Carbon::now()->format('m');
                $year=Carbon::now()->format('Y');
            }

            $month = intval($month);

             $insertion_date = $year.'-'.'0'.$month;
            $Customers = NULL;
//            $Customers = DB::table('customers')
//                ->Join('invoices', 'customers.id', '=', 'invoices.customer_id')
//                ->where('invoices.month', '<>', $request->month)
//                ->where('invoices.year', '<>', $request->year)
//                ->get();
//            dd($Customers);
           $customer_ids = Invoice::where('insertion_date', 'LIKE', $insertion_date.'%')->pluck('customer_id')->toArray();
            $Customers = Customer::query();
            if(is_array($customer_ids) && sizeof($customer_ids) > 0)
                $Customers=$Customers->whereNotIn('id', $customer_ids);
            $Customers = $Customers->get();
//        dd($Customers);
            return view('Pages.Dashboard.Invoices.Create',compact('Customers','month','year'));

        }
    public function store(Request $request){
        $month='';
        $month=$request->month;
        if(is_null($request->month)) {
            $month = Carbon::now()->format('m');
        }
//     return   Carbon::parse($request->year.'-'.$request->month.'-01')->toDateString();
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
            $Invoice->month=$month;
            $Invoice->year=$request->year;
            $Invoice->insertion_date=Carbon::parse($request->year.'-'.$month.'-01')->toDateString();
            $Invoice->save();
//                $mobile=Customer::find($Customer_ids[$key])->mobile;
//                $message=' يرجى الالتزام بتسديد المبلغ المستحق (مولد الايطالي)'.($Total[$key]).'بقيمة'.($request->month).'عزيزي المشترك قيمة فاتورة المولد لشهر';
//                $this->send($mobile,$message);
            }
            toastr()->success('تمت عملية الاضافة بنجاح');
            return redirect()->route('Invoices.index');

        } catch (\Exception $exception) {
            return $exception;
            toastr()->error('لم يتم اضافة الفاتورة');

            return redirect()->route('Invoices.index');
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
                toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح بسبب وجود دفعات ');

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
    public function fullPayment(){
        $Customers=Customer::all();

        return view('Pages.Dashboard.Invoices.fullPayment_invoice',compact('Customers'));


    }
    public function get_fullPayment_invoice(Request $request)
    {

        $button = '';

        $data = Invoice::query();
        $data->where('status',2)->get();
        if ($request->input('Customer_id')) {
            $data = $data->where("Customer_id", $request->input('Customer_id'));
        }
        if ($request->input('Month_Invoice')) {
            $data = $data->whereMonth("created_at", $request->input('Month_Invoice'));
        }
        if ($request->input('years')) {
            $data = $data->whereYear("created_at", $request->input('years'));
        }

        return Datatables::of($data)
            ->addColumn('Customer', function ($data) {
                return $data->Customer->full_name;

            }) ->addColumn('k_w_price', function ($data) {
                return $data->Customer->kw_price;
            })->addColumn('Date', function ($data) {
                return ($data->year).'-'.($data->month);

            })->addColumn('Remaining', function ($data) {
                return $data->remaining;
            })

            ->addColumn('status', function ($data) {

                if ($data->status == 0) {
                    return 'غير مدفوع';

                } else if ($data->status == 1) {
                    return 'مدفوع جزئي';

                } else if ($data->status == 2) {

                    return 'مدفوع';
                }

            })->addColumn('action', function ($data) {
                $button = '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/show") . '" . id="' . $data->id . '"><span> <i class="icon-x far fa-eye" aria-hidden="true"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button =  $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment"><span> <i class="icon-x fab fa-cc-apple-pay"></i></span></a>';
//                $button = $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment"><span> <i class="fa fa-eye" aria-hidden="true"></i>دفعة</span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button = $button . '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/edit") . '" . id="' . $data->id . '" ><span><i class="icon-x fas fa-edit"></i></span></a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a name="delete" id="' . $data->id . '" Name_Customer="' . $data->Customer->full_name .'" class="" ><span><i class="icon-x1 text-dark-50 flaticon-delete-1"></i></span></a>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }
    public function partiallyPayment(){

        $Customers=Customer::all();

        return view('Pages.Dashboard.Invoices.partially_payment_invoice',compact('Customers'));


    }
    public function get_partially_Payment_invoice(Request $request)
    {

        $button = '';

        $data = Invoice::query();
        $data->where('status',1)->get();
        if ($request->input('Customer_id')) {
            $data = $data->where("Customer_id", $request->input('Customer_id'));
        }
        if ($request->input('Month_Invoice')) {
            $data = $data->whereMonth("created_at", $request->input('Month_Invoice'));
        }
        if ($request->input('years')) {
            $data = $data->whereYear("created_at", $request->input('years'));
        }

        return Datatables::of($data)
            ->addColumn('Customer', function ($data) {
                return $data->Customer->full_name;

            }) ->addColumn('k_w_price', function ($data) {
                return $data->Customer->kw_price;
            })->addColumn('Date', function ($data) {
                return ($data->year).'-'.($data->month);

            })->addColumn('Remaining', function ($data) {
                return $data->remaining;
            })

            ->addColumn('status', function ($data) {

                if ($data->status == 0) {
                    return 'غير مدفوع';

                } else if ($data->status == 1) {
                    return 'مدفوع جزئي';

                } else if ($data->status == 2) {

                    return 'مدفوع';
                }

            })->addColumn('action', function ($data) {
                $button = '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/show") . '" . id="' . $data->id . '"><span> <i class="icon-x far fa-eye" aria-hidden="true"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button =  $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment"><span> <i class="icon-x fab fa-cc-apple-pay"></i></span></a>';
//                $button = $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment"><span> <i class="fa fa-eye" aria-hidden="true"></i>دفعة</span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button = $button . '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/edit") . '" . id="' . $data->id . '" ><span><i class="icon-x fas fa-edit"></i></span></a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a type="button" name="delete" id="' . $data->id . '" Name_Customer="' . $data->Customer->full_name .'" ><span><i class="icon-x1 text-dark-50 flaticon-delete-1"></i></span></a>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }
    public function Serach(Request $request){
        $Customers=Customer::query();
        $Customers->whereHas('Invoice', function($q) use($request){
            $q->where("status",0);
        });
        return view('Pages.Dashboard.Invoices.create',compact('Customers'));
    }
    public function unpaid_invoice(){

        $Customers=Customer::all();

        return view('Pages.Dashboard.Invoices.unpaid_invoice',compact('Customers'));


    }
    public function get_unpaid_invoice(Request $request)
    {

        $button = '';

        $data = Invoice::query();
        $data->where('status',0)->get();
        if ($request->input('Customer_id')) {
            $data = $data->where("Customer_id", $request->input('Customer_id'));
        }
        if ($request->input('Month_Invoice')) {
            $data = $data->whereMonth("created_at", $request->input('Month_Invoice'));
        }
        if ($request->input('years')) {
            $data = $data->whereYear("created_at", $request->input('years'));
        }

        return Datatables::of($data)
            ->addColumn('Customer', function ($data) {
                return $data->Customer->full_name;

            }) ->addColumn('k_w_price', function ($data) {
                return $data->Customer->kw_price;
            })->addColumn('Date', function ($data) {
                return ($data->year).'-'.($data->month);

            })->addColumn('Remaining', function ($data) {
                return $data->remaining;
            })

            ->addColumn('status', function ($data) {

                if ($data->status == 0) {
                    return 'غير مدفوع';

                } else if ($data->status == 1) {
                    return 'مدفوع جزئي';

                } else if ($data->status == 2) {

                    return 'مدفوع';
                }

            })->addColumn('action', function ($data) {

                $button = '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/show") . '" . id="' . $data->id . '"><span> <i class="icon-x far fa-eye" aria-hidden="true"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button =  $button.'<a name="payment" . id="' . $data->id . '" Name_Customer_Payment="'.$data->Customer->full_name.'" class="payment"><span> <i class="icon-x fab fa-cc-apple-pay"></i></span></a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                $button = $button . '<a name="edit" href="' . url("/Dashboard/Invoices/$data->id/edit") . '" . id="' . $data->id . '" ><span><i class="icon-x fas fa-edit"></i></span></a>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button = $button.'<a  name="delete" id="' . $data->id . '" Name_Customer="' . $data->Customer->full_name .'" class="delete"><span><i class="icon-x1 text-dark-50 flaticon-delete-1"></i></span></button>';
                return $button;

            })->rawColumns(['action'])
            ->make(true);

    }
    public function print_Invoice_pdf($id)
    {

        $history=Carbon::now()->format('Y-m-d');
        $day=Hijri::Date('l');
        $invoice = Invoice::findOrFail($id);
         $customer=   $invoice->Customer->full_name;
      $data["receipt"] = Payment::where('invoice_id',$invoice->id)->get();

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->SetWatermarkImage('assets/media/logos/logo_3.png');
        $mpdf->showWatermarkImage = true;

        $mpdf->WriteHTML(view('Pages.Dashboard.Invoices.pdf', compact('day','history','invoice'))->render());
        $mpdf->Output('فاتورة المشترك '.' '.$customer.'.pdf', 'I');
    }

    public function print_Invoice(Request $request)
    {
        $history=Carbon::now()->format('Y-m-d');
        $date=Hijri::Date('l');                         // Without Defining Timestamp It will return Hijri Date of [NOW]  => Results "الجمعة ، 12 ربيع الآخر ، 1442"

        $data='';
      if(isset($request->Customer_id) && isset($request->Month_Invoice)&& isset($request->years)&&isset($request->Status)) {
            $data = Invoice::where('customer_id', $request->input('Customer_id'))
                ->where('month', $request->input('Month_Invoice'))
                ->where('year', $request->input('years'))
                ->where('status', $request->input('Status'))->get();
        }
        else  if(isset($request->Customer_id) && isset($request->Month_Invoice)&& isset($request->years)) {
            $data = Invoice::where('customer_id', $request->input('Customer_id'))
                ->where('month', $request->input('Month_Invoice'))
                ->where('year', $request->input('years'))->get();
        }
        else if(isset($request->Status) && isset($request->Month_Invoice)&& isset($request->years)) {
            $data = Invoice::where('year', $request->input('years'))
                ->where('month', $request->input('Month_Invoice'))
                ->where('status', $request->input('Status'))->get();
        }
        else if(isset($request->Status) && isset($request->Customer_id)&& isset($request->years)) {
            $data = Invoice::where('year', $request->input('years'))
                ->where('customer_id', $request->input('Customer_id'))
                ->where('status', $request->input('Status'))->get();
        }
        else if(isset($request->Status) && isset($request->Customer_id)&& isset($request->Month_Invoice)) {
            $data = Invoice::where('month', $request->input('Month_Invoice'))
                ->where('customer_id', $request->input('Customer_id'))
                ->where('status', $request->input('Status'))->get();
        }
        else if(isset($request->Status) && isset($request->years)&& isset($request->Month_Invoice)) {
        $data = Invoice::where('month', $request->input('Month_Invoice'))
            ->where('year', $request->input('years'))
            ->where('status', $request->input('Status'))->get();
        }
        else if(isset($request->Customer_id) && isset($request->years)){
            $data = Invoice::where('customer_id', $request->input('Customer_id'))
                ->where('year', $request->input('years'))->get();
        }else if(isset($request->Customer_id) && isset($request->Month_Invoice)){
            $data = Invoice::where('customer_id', $request->input('Customer_id'))
                ->where('month', $request->input('Month_Invoice'))->get();
        }
        else if(isset($request->Customer_id) && isset($request->years)){
            $data = Invoice::where('customer_id', $request->input('Customer_id'))
                ->where('year', $request->input('years'))->get();
        }
        else if(isset($request->Customer_id) && isset($request->Status)){
            $data = Invoice::where('customer_id', $request->input('Customer_id'))
                ->where('status', $request->input('Status'))->get();
        }
        else if(isset($request->years) && isset($request->Month_Invoice)){
            $data = Invoice::where('year', $request->input('years'))
                ->where('month', $request->input('Month_Invoice'))->get();
        }
        else if(isset($request->Status) && isset($request->Month_Invoice)){
            $data = Invoice::where('status', $request->input('Status'))
                ->where('month', $request->input('Month_Invoice'))->get();
        }
        else if(isset($request->Status) && isset($request->years)){
            $data = Invoice::where('status', $request->input('Status'))
                ->where('year', $request->input('years'))->get();
        }
        else if(isset($request->Customer_id)) {
            $data = Invoice::where('customer_id', $request->input('Customer_id'))->get();
        }
        else if(isset($request->Month_Invoice)) {
            $data = Invoice::where('month', $request->input('Month_Invoice'))->get();
        }
        else if(isset($request->years)) {
            $data = Invoice::where('year', $request->input('years'))->get();
        }
        else if(isset($request->Status)) {
            $data = Invoice::where('status', $request->input('Status'))->get();
        }

else{
    $data=Invoice::get();
}
    //        if($data->count()==0) {
//            $data = Invoice::get();
//
//        }
        $current_reading=0;
        $previous_reading=0;
        $total_kw=0;
        $total_price=0;
        foreach ($data as $invoice){
            $current_reading+= $invoice->current_reading;
            $previous_reading+=$invoice->previous_reading;
            $total_kw+=$invoice->total_kw;
            $total_price+=$invoice->total_price;
        }
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->SetWatermarkImage('assets/media/logos/logo.png');
        $mpdf->showWatermarkImage = true;

        $mpdf->WriteHTML(view('Pages.Dashboard.Invoices.print', compact('history','date','data','current_reading','previous_reading','total_kw','total_price'))->render());
        $mpdf->Output('كشف الفواتير'.' '.' '.$request->month.'.pdf', 'I');
    }


    public function excel(Request $request){
        return \Maatwebsite\Excel\Facades\Excel::download(new InvoiceExport($request), 'invoices.xlsx');
    }


}
