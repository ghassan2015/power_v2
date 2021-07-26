<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $Invoices=Invoice::get();

        $total_fully_paidds=0;
        $total_Partially_paidds=0;
        $total_unPaidds=0;
        $total_invoice=0;
        $total_Expenses=0;
        foreach ($Invoices  as $Invoice){
            $total_invoice+=$Invoice->total_price;
        }
        $fully_paidds= Invoice::where('remaining',0)->get();
          foreach ($fully_paidds  as $fully_paid){
            $total_fully_paidds+=$fully_paid->total_price;
        }
        $Partially_paidds = Invoice::where('total_price','<','remaining')->where('remaining','<>',0)->where('status',1)->get();
        foreach ($Partially_paidds  as $Partially_paid){
            $total_Partially_paidds+=($Partially_paid->total_price)-($Partially_paid->remaining);
        }
        $unPaidds=Invoice::where('status',0)->get();
        foreach ($unPaidds  as $unPaid){
            $total_unPaidds+=($unPaid->total_price);


        }
        $Customers=Customer::get();
        $Expenses=Expense::get();
        foreach ($Expenses  as $Expense){
            $total_Expenses+=($Expense->price_expenses);


        }
        return view('Pages.Dashboard.index',compact('Invoices','total_invoice','fully_paidds','total_fully_paidds','unPaidds','total_unPaidds','Partially_paidds','total_Partially_paidds','Customers','Expenses','total_Expenses'));
    }
}
