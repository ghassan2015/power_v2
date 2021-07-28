<?php

namespace App\Http\Controllers\Customers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Requests\CustomersLoginRequest;
use App\Http\Requests\CustomersLoginRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }
//    protected $redirectTo = RouteServiceProvider::Customers;


    public function login()
    {

        return view('Pages.Customers.login.login');
    }


    public function postLogin(CustomersLoginRequest $request)
    {
//        return $request;


        if (Auth::guard('customer')->attempt($request->only('email','password'))) {
            return redirect()->route('Customer.Invoices.index');

        }

        return view('Pages.Customers.login.login');

    }


    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();


        return redirect()->route('Customers.login');
    }

    private function getGaurd()
    {
        return auth('customer');
    }


}
