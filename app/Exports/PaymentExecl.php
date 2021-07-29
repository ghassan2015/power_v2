<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExecl implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {

        $data = '';
        $customer_id = Invoice::where('customer_id',$this->request->Customer_id)->pluck('id')->toarray();
        $data = Payment::orwhereIn('invoice_id', $customer_id)
            ->orwhere('month', $this->request->input('Month_Payment'))
            ->orwhere('year', $this->request->input('Years_Payment'))
            ->get();


        if ($data->count() == 0) {
            $data = Payment::get();
        }
        return view('Pages.Dashboard.Payment.excel', [
            'Payments' => $data
        ]);
    }
}
