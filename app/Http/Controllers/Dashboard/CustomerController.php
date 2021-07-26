<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Subtype;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $Customers=Customer::all();
        return view('Pages.Dashboard.Customers.index',compact('Customers'));

    }
    public function get_custom_Customer(Request $request)
    {
        $button='';
        $data = Customer::query();
        if ($request->input('full_name')) {
            $data = $data->where("full_name", $request->input('full_name'));
        }
        if ($request->input('email')) {
            $data = $data->where("email", $request->input('email'));
        }
        if ($request->input('mobile')) {
            $data = $data->where("mobile", $request->input('mobile'));
        }
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<a id="' . $data->id . '" href="' . url("Dashboard/Customers/$data->id/edit") . '"><i class="icon-2x text-dark-50 flaticon-edit-1" style="color: #33F9FF"></i>  </a>';
                $button.='&nbsp;&nbsp;';
                $button .= '<a href="' . url("Dashboard/Customers/$data->id/AccountStatement") . '"><span><i class="icon-2x text-dark-50 flaticon2-printer" ></i> </span></a>';

                return $button;

            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function cheackemail($email){
        $email=Customer::where('email',$email)->get();
        return $email;
}




    public function create()
    {
        $Sub_types=Subtype::all();
        return view('Pages.Dashboard.Customers.create',compact('Sub_types'));
    }
    public function AccountStatement($id){
        $Customer= Customer::findorfail($id);
        $Invoices=Invoice::where('customer_id',$Customer->id)->get();
        return view('Pages.Dashboard.Customers.account_value',compact('Customer','Invoices'));
    }


    public function Store(CustomerRequest $request)
    {
        try {
            $Customer = new Customer();
            $Customer->full_name = $request->name;
            $Customer->email = $request->email;
            $Customer->password = Hash::make($request->password);
            $Customer->mobile = $request->phone;
            $Customer->kw_price = $request->price;
            $Customer->location = $request ->location;
            $Customer->kw_meter_value=$request->meter_value;
            $Customer->meter_number=$request->meter;
            $Customer->subtype_id=$request->subtype_id;
            $Customer->status=$request->status;
            $Customer->note=$request->note;
            $Customer->save();
            toastr()->success('تمت عملية الحفظ بنجاح');
            return redirect()->route('Customers.index');
        }catch (\Exception $ex){
            return $ex;
            toastr()->error('لم يتم الاضافة هناك خلل ما يرجى المحاولة لاحقا');
            return redirect()->route('Customers.index');

        }

    }
    public function edit($id){
        $Sub_types=Subtype::all();
        $Customer=Customer::findOrFail($id);
        return view('Pages.Dashboard.Customers.edit',compact('Customer','Sub_types'));
    }
    public function update(CustomerUpdateRequest $request,$id)
    {
        try {
            $Customer=Customer::findOrFail($id);
            $Customer->full_name = $request->name;
            $Customer->email = $request->email;
            $Customer->password = Hash::make($request->password);
            $Customer->mobile = $request->phone;
            $Customer->kw_price = $request->price;
            $Customer->location = $request ->location;
            $Customer->kw_meter_value=$request->meter_value;
            $Customer->meter_number=$request->meter;
            $Customer->subtype_id=$request->subtype_id;
            $Customer->status=$request->status;
            $Customer->note=$request->note;
            $Customer->save();
            toastr()->success('تمت عملية التعديل بنجاح');
            return redirect()->route('Customers.index');
        }catch (\Exception $ex){
            toastr()->error('لم يتم الاضافة هناك خلل ما يرجى المحاولة لاحقا');
            return redirect()->route('Customers.index');

        }

    }

    public function getType($id){
        $subType=Subtype::where('id',$id)->get();
        return $subType;
    }

    public function destroy(Request $request){
        try {
            $customer=Customer::where('id',$request->id)->delete();
            toastr()->success('تمت عملية الحذف بنجاح');
            return redirect()->route('Customers.index');

        }catch (\Exception $exception){
            toastr()->error('لم يتم الاضافة هناك خلل ما يرجى المحاولة لاحقا');
            return redirect()->route('Customers.index');

        }

    }
    public function pdf(Request $request){
        $data='';
        $data = Customer::orwhere('full_name', $request->input('full_name'))
                ->orwhere('email', $request->input('email'))
                ->orwhere('mobile', $request->input('mobile'))->get();
        if($data->count()==0){
          $data=Customer::get();
        }


        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->SetWatermarkImage('assets/media/logos/logo.png');
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML(view('Pages.Dashboard.Customers.pdf', compact('data'))->render());
        $mpdf->Output('كشف المشتركين'.' '.' '.$request->full_name.'.pdf', 'I');
    }

    public function print_Invoice_pdf(Request $request)
    {


        $data = Customer::orwhere('full_name', $request->input('full_name'))
            ->orwhere('email', $request->input('email'))
            ->orwhere('mobile', $request->input('mobile'))->get();

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->SetWatermarkImage('assets/media/logos/logo.png');
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML(view('Pages.Dashboard.Invoices.pdf', compact('invoice'))->render());
        $mpdf->Output('قائمة المشتركين '.''.'.pdf', 'I');
    }

}
