<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    use GeneralTrait;

    public function index(){
        $customers=Customer::get();
        return $this -> returnData('customers',$customers);
    }
    public function store(Request $request){
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
            return $this -> returnSuccessMessage('تم حفظ البيانات بنجاح');
        }catch (\Exception $exception){
            return $this->returnError(500,'هناك خطا ما يرجى التاكد مرة اخرى ');
        }
    }
//    public function getType($id){
//        $getType=
//    }
    //
    public function update(Request $request){

        try {


     $Customer =  Customer::findOrFail($request->id);
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
        return $this -> returnSuccessMessage('تم تعديل البيانات بنجاح');
    }catch (\Exception $exception){
            return $this -> returnError(500,'هناك خطا ما يرجى المحاولة مرة اخرى');
        }
    }
    public function delete(Request $request)
    {
        try {
            $Customer =  Customer::findOrFail($request->id);
            $Invoice=Invoice::where('customer_id',$Customer->id)->get();
          if($Invoice->count()>0){
          return $this -> returnError(505,'لا يمكن حذف هذا المشترك بسبب وجود فواتير تابعه له');

    }else {
    Customer::destroy($request->id);
    return $this->returnSuccessMessage('تم عملية حذف البيانات بنجاح');
}
        }catch (\Exception $exception){
            return $this -> returnError(500,'هناك خطا ما يرجى المحاولة مرة اخرى');

        }
        }
}
