<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ExpenseExecl implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        $data = '';
        if(isset($this->request->Option_id) && isset($this->request->Month_Expense)&& isset($this->request->Year_Expense))
        {
            $data = Expense::where('option_id', $this->request->input('Option_id'))
                ->whereMonth("created_at", $this->request->input('Month_Expense'))
                ->whereYear('created_at', $this->request->input('Year_Expense'))->get();
        }else if(isset($this->request->Option_id) && isset($this->request->Month_Expense)){
            $data = Expense::where('option_id', $this->request->input('Option_id'))
                ->whereMonth("created_at", $this->request->input('Month_Expense'))->get();
        }else if(isset($this->request->Option_id) && isset($this->request->Year_Expense)){
            $data = Expense::where('option_id', $this->request->input('Option_id'))
                ->whereYear('created_at', $this->request->input('Year_Expense'))->get();
        }else if (isset($this->request->Month_Expense) && isset($this->request->Year_Expense)){
            $data = Expense:: whereMonth("created_at", $this->request->input('Month_Expense'))
                ->whereYear('created_at', $this->request->input('Year_Expense'))->get();
        }else if(isset($this->Month_Expense) ){
            $data = Expense:: whereMonth("created_at", $this->request->input('Month_Expense'))->get();
        }else if(isset($this->request->Year_Expense) ){
            $data = Expense::whereYear('created_at', $this->request->input('Year_Expense'))->get();

        }else if(isset($this->request->Option_id) ){
            $data = Expense::where('option_id', $this->request->input('Option_id'))->get();
        }else{
            $data=Expense::get();
        }
        return view('Pages.Dashboard.Expense.excel', compact('data'));


    }
}
