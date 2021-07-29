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
        $data = Invoice::orwhere('customer_id', $this->request->input('Customer_id'))
            ->orwhere('month', $this->request->input('Month_Invoice'))
            ->orwhere('year', $this->request->input('years'))->get();
        if($data->count()==0) {
            $data = Invoice::get();

        }
        return view('Pages.Dashboard.Invoices.execl', [
            'expenses' => $data
        ]);
    }


}
