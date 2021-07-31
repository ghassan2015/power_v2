<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
class InvoiceExport implements FromView
{
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }


    public function view(): View
    {
        $data='';
        if(isset($this->request->Customer_id) && isset($this->request->Month_Invoice)&& isset($this->request->years)&&isset($this->request->Status)) {
            $data = Invoice::where('customer_id', $this->request->input('Customer_id'))
                ->where('month', $this->request->input('Month_Invoice'))
                ->where('year', $this->request->input('years'))
                ->where('status', $this->request->input('Status'))->get();
        }
        else  if(isset($this->request->Customer_id) && isset($this->request->Month_Invoice)&& isset($this->request->years)) {
            $data = Invoice::where('customer_id', $this->request->input('Customer_id'))
                ->where('month', $this->request->input('Month_Invoice'))
                ->where('year', $this->request->input('years'))->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Month_Invoice)&& isset($this->request->years)) {
            $data = Invoice::where('year', $this->request->input('years'))
                ->where('month', $this->request->input('Month_Invoice'))
                ->where('status', $this->request->input('Status'))->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Customer_id)&& isset($this->request->years)) {
            $data = Invoice::where('year', $this->request->input('years'))
                ->where('customer_id', $this->request->input('Customer_id'))
                ->where('status', $this->request->input('Status'))->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Customer_id)&& isset($this->request->Month_Invoice)) {
            $data = Invoice::where('month', $this->request->input('Month_Invoice'))
                ->where('customer_id', $this->request->input('Customer_id'))
                ->where('status', $this->request->input('Status'))->get();
        }
        else if(isset($this->request->Status) && isset($this->request->years)&& isset($this->request->Month_Invoice)) {
            $data = Invoice::where('month', $this->request->input('Month_Invoice'))
                ->where('year', $this->request->input('years'))
                ->where('status', $this->request->input('Status'))->get();
        }
        else if(isset($this->request->Customer_id) && isset($this->request->years)){
            $data = Invoice::where('customer_id', $this->request->input('Customer_id'))
                ->where('year', $this->request->input('years'))->get();
        }else if(isset($this->request->Customer_id) && isset($this->request->Month_Invoice)){
            $data = Invoice::where('customer_id', $this->request->input('Customer_id'))
                ->where('month', $this->request->input('Month_Invoice'))->get();
        }
        else if(isset($this->request->Customer_id) && isset($this->request->years)){
            $data = Invoice::where('customer_id', $this->request->input('Customer_id'))
                ->where('year', $this->request->input('years'))->get();
        }
        else if(isset($this->request->Customer_id) && isset($this->request->Status)){
            $data = Invoice::where('customer_id', $this->request->input('Customer_id'))
                ->where('status', $this->request->input('Status'))->get();
        }
        else if(isset($this->request->years) && isset($this->request->Month_Invoice)){
            $data = Invoice::where('year', $this->request->input('years'))
                ->where('month', $this->request->input('Month_Invoice'))->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Month_Invoice)){
            $data = Invoice::where('status', $this->request->input('Status'))
                ->where('month', $this->request->input('Month_Invoice'))->get();
        }
        else if(isset($this->request->Status) && isset($this->request->years)){
            $data = Invoice::where('status', $this->request->input('Status'))
                ->where('year', $this->request->input('years'))->get();
        }
        else if(isset($this->request->Customer_id)) {
            $data = Invoice::where('customer_id', $this->request->input('Customer_id'))->get();
        }
        else if(isset($this->request->Month_Invoice)) {
            $data = Invoice::where('month', $this->request->input('Month_Invoice'))->get();
        }
        else if(isset($this->request->years)) {
            $data = Invoice::where('year', $this->request->input('years'))->get();
        }
        else if(isset($this->request->Status)) {
            $data = Invoice::where('status', $this->request->input('Status'))->get();
        }

        else{
            $data=Invoice::get();
        }
        return view('Pages.Dashboard.Invoices.execl', [
            'expenses' => $data
        ]);
    }


}
