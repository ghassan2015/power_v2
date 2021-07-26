<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function Formlogin()
    {
        return view('auth.login');
    }
        public function login( Request $request){
        if (auth()->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {

            return redirect()->route('Dashboard.index');
        }

        return view('auth.login');
    }
}
