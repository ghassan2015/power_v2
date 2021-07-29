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
        $data='';
        $data = Customer::orwhere('full_name', $this->request->input('full_name'))
            ->orwhere('email', $this->request->input('email'))
            ->orwhere('mobile', $this->request->input('mobile'))->get();
        if($data->count()==0){
            $data=Customer::get();
        }
        return view('Pages.Dashboard.Customers.excel', [
            'Customers' => $data
        ]);
    }

}
