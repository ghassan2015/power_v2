<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){

                    $button = '&nbsp;&nbsp;&nbsp<a class="edit btn btn-primary btn-sm"  id="' . $data->id . '" href="' . url("Dashboard/Customers/$data->id/edit") . '"><i class="fas fa-user-edit"></i> تعديل </a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" Name_Customer="' . $data->name . '"  class="delete btn btn-danger btn-sm"><span><i class="fas fa-user-minus"></i></span>حذف</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Pages.Dashboard.Customers.index');

    }


    public function create()
    {
        $Sub_types=Subtype::all();
        return view('Pages.Dashboard.Customers.create',compact('Sub_types'));
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
}
