<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequst;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $button = '';
        if ($request->ajax()) {
            $data = \App\Models\Option::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $button = '<a name="edit"   id="' . $data->id . '" Name_Option="' . $data->Name . '" class="edit btn btn-primary btn-sm edit_Option"><span><i class="fas fa-edit edit_Option"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" Name_Delete="' . $data->Name . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('Pages.Dashboard.Expense.Option.index');

    }





    public function store(OptionRequst $request)
    {

        // $validated = $request->validated();

        try {
            $Option = new \App\Models\Option();
            $Option->Name = $request->Name;
            $Option->save();
            toastr()->success('تمت عملية الاضافة بنجاح');
            return redirect()->route('Options.index');

        } catch (\Exception $e) {
            toastr()->error('هناك خطا ما يرجى المحاولة لاحقا');
            return redirect()->route('Options.index');

        }

    }





    public function update(OptionRequst $request, $id)
    {


        $option = \App\Models\Option::findOrFail($request->id);


        if (!$option) {
            toastr()->error('هذا الصندوق غير موجود حاول مرة اخرى');
            return redirect()->route('Boxs.index');
        }
        $option->Name = $request->Name;

        $option->save();
        toastr()->success('تمت عملية التعديل بنجاح');
        return redirect()->route('Options.index');

    }


    public function destroy(Request $request)
    {
        try {
            $Expense_id = Expense::where('Option_id', $request->id)->pluck('Option_id');
            if ($Expense_id->count() == 0) {
                \App\Models\Option::findOrFail($request->id)->delete();
                toastr()->success('تمت عملية التعديل بنجاح');
                return redirect()->route('Options.index');

            } else {
                toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح بسبب وجود ابناء له');
                return redirect()->route('Options.index');
            }
        } catch (\Exception $exception) {
            toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح');
            return redirect()->route('Options.index');

        }
    }
}
