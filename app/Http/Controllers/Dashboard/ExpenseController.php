<?php

namespace App\Http\Controllers\Dashboard;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Exports\ExpenseExecl;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Datatables;

class ExpenseController extends Controller
{

    public function index(){
        $Options=Option::all();

        return view('Pages.Dashboard.Expense.index',compact('Options'));

    }
    public function getExpense(Request $request)
    {

        $button = '';

        $data = Expense::query();
        if ($request->input('Option_id')) {
            $data = $data->where("option_id", $request->input('Option_id'));
        }
        if ($request->input('Month_Expense')) {
            $data = $data->whereMonth("created_at", $request->input('Month_Expense'));
        }

        if ($request->input('Year_Expense')) {

            $data = $data->whereYear("created_at", $request->input('Year_Expense'));
        }
return  \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" id="' . $data->id . '"   Name_Expense="' . $data->name . '" Option_id="' . $data->option_id . '"  Option_Name="' . $data->Option->name . '" Price="' . $data->price_expenses . '"  class="edit  edit_Expense"><span><i class="fas fa-edit"></i></span></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                    $button .= '<a type="button" name="delete" Name_Expense="' . $data->name . '" id="' . $data->id . '" class="delete"><span><i class="fas fa-trash-alt"></i></span></a>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);



    }


    public function store(ExpenseRequest $request)
    {
        try {
            $Expense = new Expense();
            $Expense->name = $request->Name;
            $Expense->price_expenses = $request->Value;
            $Expense->option_id = $request->Option_id;
            $Expense->save();
            toastr()->success('???? ?????????? ?????????? ?????????????????? ??????????');
            return redirect()->route('Expense.index');
        } catch (\Exception $ex) {
            toastr()->error('???????? ?????? ???? ?????????? ???????????????? ?????????? ');
            return redirect()->route('Expense.index');

        }

    }

    public function edit($id)
    {
        $Expense = Expense::findOrFail($id);
        return view('Pages.Expense.edit', compact('Expense'));

    }

    public function update(ExpenseRequest $request)
    {
        try {
            $Expense = Expense::findOrFail($request->id);
            $Expense->name = $request->Name;
            $Expense->price_expenses = $request->Value;
            $Expense->option_id = $request->Option_id;
            $Expense->save();
            toastr()->success('???? ?????????? ?????????? ?????????????????? ??????????');
            return redirect()->route('Expense.index');
        } catch (\Exception $ex) {
            toastr()->error('???????? ?????? ???? ?????????? ???????????????? ?????????? ');
            return redirect()->route('Expense.index');
        }
    }

    public function destroy(Request $request)
    {


        Expense::where('id', $request->id)->delete();

        toastr()->success('?????? ?????????? ?????????????? ??????????');
        return redirect()->route('Expense.index');
    }
    public function pdf(Request $request){
        $data='';
        if(isset($request->Option_id) && isset($request->Month_Expense)&& isset($request->Year_Expense))
        {
            $data = Expense::where('option_id', $request->input('Option_id'))
                ->whereMonth("created_at", $request->input('Month_Expense'))
                ->whereYear('created_at', $request->input('Year_Expense'))->get();
        }else if(isset($request->Option_id) && isset($request->Month_Expense)){
            $data = Expense::where('option_id', $request->input('Option_id'))
                ->whereMonth("created_at", $request->input('Month_Expense'))->get();
        }else if(isset($request->Option_id) && isset($request->Year_Expense)){
            $data = Expense::where('option_id', $request->input('Option_id'))
                ->whereYear('created_at', $request->input('Year_Expense'))->get();
        }else if (isset($request->Month_Expense) && isset($request->Year_Expense)){
            $data = Expense:: whereMonth("created_at", $request->input('Month_Expense'))
                ->whereYear('created_at', $request->input('Year_Expense'))->get();
        }else if(isset($request->Month_Expense) ){
            $data = Expense:: whereMonth("created_at", $request->input('Month_Expense'))->get();
        }else if(isset($request->Year_Expense) ){
            $data = Expense::whereYear('created_at', $request->input('Year_Expense'))->get();

        }else if(isset($request->Option_id) ){
            $data = Expense::where('option_id', $request->input('Option_id'))->get();
        }else{
            $data=Expense::get();
        }
//            $data = Expense::where('option_id', $request->input('Option_id'))
//            ->orwhereMonth("created_at", $request->input('Month_Expense'))
//            ->orwhere('created_at', $request->input('Year_Expense'))->get();
//         if($data->count()==0) {
//            $data = Expense::get();
//          }
        $total_price=0;
foreach ($data as $Expense){
    $total_price+=$Expense->price_expenses;
}
        $history=Carbon::now()->format('Y-m-d');
        $day=Hijri::Date('l');

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
        $mpdf->SetWatermarkImage('assets/media/logos/logo.png');
        $mpdf->showWatermarkImage = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML(view('Pages.Dashboard.Expense.print', compact('data','total_price','day','history'))->render());
        $mpdf->Output('?????? ???????????????? ??????????????????'.' '.' '.$request->month.'.pdf', 'I');
    }

    public function excel(Request $request){
        return \Maatwebsite\Excel\Facades\Excel::download(new ExpenseExecl($request), 'Expense.xlsx');
    }
}
