<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Models\Customer;
use App\Models\Payment;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $options = '';
        if ($request->ajax()) {
            $data = User::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '&nbsp;&nbsp;&nbsp<a class="edit btn btn-primary btn-sm"  id="' . $data->id . '" href="' . url("Dashboard/users/$data->id/edit") . '"><i class="fas fa-user-edit"></i> تعديل </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" name_delete="' . $data->name . '" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('Pages.Dashboard.User.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('Pages.Dashboard.User.Add__user', compact('roles'));
    }

    public function store(UserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles_name' => $request->roles_name,
            'status' => $request->Status,
        ]);
        $user->assignRole($request->input('roles_name'));


        toastr()->success('تمت عملية الاضافة بنجاح');

            return redirect()->route('users.index')
                ->with('success', 'تم اضافة المستخدم بنجاح');




    }


    public function show($id)
    {
        $user = User::find($id);
        return view('Pages.Dashboard.User.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('Pages.Dashboard.User.edit', compact('user', 'roles', 'userRole'));
    }


    public function update(Request $request, $id)
    {

        if (!$request->has('Status'))
            $request->request->add(['Status' => 1]);
        else
            $request->request->add(['Status' => 0]);
        $input = $request->all();
//        if (!empty($input['password'])) {
//            $input['password'] = Hash::make($input['password']);
//        } else {
//            $input = array_except($input, array('password'));
//        }
        $user = User::findOrFail($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        toastr()->success('تمت عملية التعديل بنجاح');


        return redirect()->route('users.index')
            ->with('success', 'تم تحديث معلومات المستخدم بنجاح');
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
            $User_id = Payment::where('user_id', $request->id)->pluck('invoice_id');
            if ($User_id->count() == 0) {
                \App\User::findOrFail($request->id)->delete();
                toastr()->success('تمت عملية التعديل بنجاح');
            } else {
                toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح بسبب وجود ابناء له');

            }
            return redirect()->back();

        } catch (\Exception $exception) {
            toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح');
            return redirect()->route('users.index');

        }


        User::find($request->id)->delete();
        toastr()->success('تمت عملية الحذف بنجاح');

        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }

}
