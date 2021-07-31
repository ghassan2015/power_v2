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
        $Status= Invoice::where('status',$this->request->Status)->pluck('id')->toarray();


        if(isset($this->request->Customer_id) && isset($this->request->Month_Payment)&& isset( $this->request->Years_Payment)&&isset($this->request->Status)) {
            $data = Payment::whereIn('invoice_id', $customer_id)
                ->where('month',$this->request->Month_Payment)
                ->where('year',$this->request->Years_Payment)
                ->whereIn('invoice_id', $Status)
                ->get();

        }
        else  if(isset($this->request->Customer_id) && isset($this->request->Month_Payment)&& isset($this->request->Years_Payment)) {
            $data = Payment::orwhereIn('invoice_id', $customer_id)
                ->where('month',$this->request->Month_Payment)
                ->where('year',$this->request->Years_Payment)
                ->get();
        }
        else if(isset($this->request->Status) && isset($request->Month_Payment)&& isset($request->Years_Payment)) {
            $data = Payment::where('month',$this->request->Month_Payment)
                ->where('year',$this->request->Years_Payment)
                ->whereIn('invoice_id', $Status)
                ->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Customer_id)&& isset($this->request->Years_Payment)) {
            $data = Payment::whereIn('invoice_id', $customer_id)
                ->where('year',$this->request->Years_Payment)
                ->whereIn('invoice_id', $Status)
                ->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Customer_id)&& isset($this->request->Month_Payment)) {
            $data = Payment::orwhereIn('invoice_id', $customer_id)
                ->where('month',$this->request->Month_Payment)
                ->whereIn('invoice_id', $Status)
                ->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Years_Payment)&& isset($this->request->Month_Payment)) {
            $data = Payment::here('month',$this->request->Month_Payment)
                ->where('year',$this->request->Years_Payment)
                ->whereIn('invoice_id', $Status)
                ->get();
        }
        else if(isset($this->request->Customer_id) && isset($this->request->Years_Payment)){
            $data = Payment::whereIn('invoice_id', $customer_id)
                ->where('year',$this->request->Years_Payment)
                ->get();
        }
        else if(isset($this->request->Customer_id) && isset($this->request->Month_Payment)){
            $data = Payment::whereIn('invoice_id', $customer_id)
                ->where('month',$this->request->Month_Payment)
                ->get();
        }
        else if(isset($this->request->Customer_id) && isset($this->request->Years_Payment)){
            $data = Payment::whereIn('invoice_id', $customer_id)
                ->where('year',$this->request->Years_Payment)
                ->get();
        }
        else if(isset($this->request->Customer_id) && isset($this->request->Status)){
            $data = Payment::whereIn('invoice_id', $customer_id)
                ->whereIn('invoice_id', $Status)
                ->get();
        }
        else if(isset($this->request->Years_Payment) && isset($this->request->Month_Payment)){
            $data = Payment::where('month',$this->request->Month_Payment)
                ->where('year',$this->request->Years_Payment)
                ->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Month_Payment)){
            $data = Payment::where('month',$this->request->Month_Payment)
                ->whereIn('invoice_id', $Status)
                ->get();
        }
        else if(isset($this->request->Status) && isset($this->request->Years_Payment)){
            $data = Payment::where('year',$this->request->Years_Payment)
                ->whereIn('invoice_id', $Status)
                ->get();
        }
        else if(isset($this->request->Customer_id)) {
            $data = Payment::whereIn('invoice_id', $customer_id)->get();
        }
        else if(isset($this->request->Month_Payment)) {
            $data = Payment::where('month',$this->request->Month_Payment)
                ->get();
        }
        else if(isset($this->request->Years_Payment)) {
            $data = Payment::where('year',$this->request->Years_Payment)
                ->get();        }
        else if(isset($this->request->Status)) {
            $data = Payment::whereIn('invoice_id', $Status)
                ->get();
        }

        else{
            $data=Payment::get();
        }


        return view('Pages.Dashboard.Payment.excel', [
            'Payments' => $data
        ]);
    }
}
