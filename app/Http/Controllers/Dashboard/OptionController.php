<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequst;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OptionController extends Controller
{
    public function index(Request $request)
    {
        $button = '';
        if ($request->ajax()) {
            $data = \App\Models\Option::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $button = '<a name="edit"   id="' . $data->id . '" Name_Option="' . $data->name . '" class="edit edit_Option"><span><i class="fas fa-edit edit_Option"></i></span></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $button .= '<a type="button" name="delete" id="' . $data->id . '" Name_Delete="' . $data->name . '" class="delete"><span><i class="fas fa-trash-alt"></i></span></a>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('Pages.Dashboard.Expense.Option.index');

    }


    public function create()
    {
        //
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


    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $Expense_id = Expense::where('Option_id', $request->id)->pluck('Option_id');
            if ($Expense_id->count() == 0) {
                \App\Models\Option::findOrFail($request->id)->delete();
                toastr()->success('تمت عملية التعديل بنجاح');
                return redirect()->route('Options.index');

            } else {
                toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح بسبب وجود مصاريف تشغيلية له');
                return redirect()->route('Options.index');
            }
        } catch (\Exception $exception) {
            toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح');
            return redirect()->route('Options.index');

        }
    }
}
