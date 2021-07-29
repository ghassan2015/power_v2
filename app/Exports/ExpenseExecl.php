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
        $data = Expense::orwhere('option_id', $this->request->input('Option_id'))
            ->orwhereMonth("created_at", $this->request->input('Month_Expense'))
            ->orwhere('created_at', $this->request->input('Year_Expense'))->get();
        if ($data->count() == 0) {
            $data = Expense::get();
        }
        return view('Pages.Dashboard.Expense.excel', compact('data'));


    }
}
