<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExcel implements FromView
{

    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        if(isset($this->request->full_name) && isset($this->request->email)&& isset($this->request->mobile)) {
            $data = Customer::where('full_name', $this->request->input('full_name'))
                ->where('email', $this->request->input('email'))
                ->where('mobile', $this->request->input('mobile'))->get();
        }else  if(isset($this->request->full_name) && isset($this->request->email)){
            $data = Customer::where('full_name', $this->request->input('full_name'))
                ->where('email', $this->request->input('email'))
                ->get();
        } else if (isset($this->request->full_name) && isset($this->request->mobile)){
            $data = Customer::where('full_name', $this->request->input('full_name'))
                ->where('mobile', $this->request->input('mobile'))->get();
        }else if(isset($this->request->email)&& isset($this->request->mobile)){
            $data=  Customer::where('email', $this->request->input('email'))
                ->where('mobile', $this->request->input('mobile'))->get();
        }   else if (isset($this->request->full_name)) {
            $data = Customer::where('full_name', $this->request->input('full_name'))->get();
        }
        else if (isset($this->request->email)){
            $data=  Customer::where('email', $this->request->input('email'))->get();
        }else if(isset($this->request->mobile)){
            $data=  Customer::where('mobile', $this->request->input('mobile'))->get();
        }else{
            $data=  Customer::get();

        }
        return view('Pages.Dashboard.Customers.excel', [
            'Customers' => $data
        ]);
    }

}
