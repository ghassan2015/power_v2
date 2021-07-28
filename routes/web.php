<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//    Route::get('/pdf-table-data', function () {
//        $users = \App\User::all();
//        $data=[
//            'users' => $users
//        ];
//        $pdf = PDF::loadView('test',['data',$data]);
//        $pdf->autoScriptToLang = true;
//        $pdf->autoArabic = true;
//        $pdf->autoLangToFont = true;
//        return $pdf->download('test.pdf');
//    });

Route::group(['namespace' => 'Dashboard', 'prefix' => 'Dashboard','middleware'=>'auth'], function () {


        Route::get('/', 'HomeController@index')->name('Dashboard.index');

    Route::get('/Customers', 'CustomerController@index')->name('Customers.index');
    Route::get('/Customers/get_custom_Customer', 'CustomerController@get_custom_Customer')->name('Customers.get_custom_Customer');
    Route::get('/Customers/Create', 'CustomerController@create')->name('Customers.create');
    Route::get('/Customers/{id}/edit', 'CustomerController@edit');
    Route::get('/Customers/{id}/AccountStatement', 'CustomerController@AccountStatement');
    Route::get('/Customers/email/{email}', 'CustomerController@cheackemail');
    Route::post('/Customers', 'CustomerController@Store')->name('Customers.Store');
    Route::get('/Customers/Subtype/{id}', 'CustomerController@getType');
    Route::put('/Customers/{id}', 'CustomerController@update')->name('Customers.update');
    Route::delete('/destroy/', 'CustomerController@destroy')->name('Customers.destroy');
    Route::get('/Customers/pdf', 'CustomerController@pdf')->name('Customers.pdf');


    Route::get('/Invoices/', 'InvoiceController@index')->name('Invoices.index');
    Route::get('/Invoices/get_custom_invoice', 'InvoiceController@get_custom_invoice')->name('Invoices.get_custom_invoice');
    Route::get('/Invoices/fullPayment', 'InvoiceController@fullPayment')->name('Invoices.fullPayment');
    Route::get('/Invoices/get_fullPayment_invoice', 'InvoiceController@get_fullPayment_invoice')->name('Invoices.get_fullPayment_invoice');
    Route::get('/Invoices/partially_payment_invoice', 'InvoiceController@partiallyPayment')->name('Invoices.partially_payment');
    Route::get('/Invoices/get_partially_payment_invoice', 'InvoiceController@get_partially_Payment_invoice')->name('Invoices.get_partially_payment_invoice');
    Route::get('/Invoices/unpaid_invoice', 'InvoiceController@unpaid_invoice')->name('Invoices.unpaid_invoice');
    Route::get('/Invoices/get_unpaid_invoice', 'InvoiceController@get_unpaid_invoice')->name('Invoices.get_unpaid_invoice');
    Route::get('/Invoices/Create', 'InvoiceController@create')->name('Invoices.create');
    Route::get('/Invoices/Serach', 'InvoiceController@Serach')->name('Invoices.serach');
    Route::post('/Invoices/', 'InvoiceController@store')->name('Invoices.store');
    Route::get('/Invoices/Customer/{id}', 'InvoiceController@getInvoice')->name('Invoices.getInvoice');
    Route::get('/Invoices/{id}/show', 'InvoiceController@show')->name('Invoices.show');
    Route::get('/Invoices/{id}/edit', 'InvoiceController@edit')->name('Invoices.edit');
    Route::put('/Invoices/{id}/', 'InvoiceController@update')->name('Invoices.update');
    Route::delete('/Invoices/', 'InvoiceController@destroy')->name('Invoices.destroy');
    Route::get('Invoices/print/{id}', ['as' => 'invoice.print', 'uses' => 'InvoiceController@printt']);
    Route::get('Invoices/pdf/{id}', ['as' => 'invoice.pdf', 'uses' => 'InvoiceController@pdf']);
    Route::get('/Invoices/{id}/print_Invoice_pdf', 'InvoiceController@print_Invoice_pdf')->name('Invoices.print_Invoice_pdf');
    Route::get('/Invoices/print_Invoice', 'InvoiceController@print_Invoice')->name('Invoices.print_Invoice');


    Route::get('/Payments/', 'PaymentController@index')->name('Payments.index');
    Route::get('/Payments/get_custom_payment', 'PaymentController@get_custom_payment')->name('Payments.get_custom_payment');
    Route::get('/Payments/{id}/show', 'PaymentController@show')->name('Payments.show');
    Route::post('/Payments/', 'PaymentController@store')->name('Invoices.payment.store');
    Route::put('/Payments/', 'PaymentController@update')->name('Payments.update');
    Route::get('/Payments/print_Payment', 'PaymentController@print_Payment')->name('Payments.print_Payment');
    Route::delete('/Payments/', 'PaymentController@destroy')->name('Payments.destroy');


    Route::get('/Roles/', 'RoleController@index')->name('Roles.index');
    Route::get('/Roles/Create', 'RoleController@create')->name('Roles.create');
    Route::get('/Roles/{id}/show', 'RoleController@show')->name('Roles.show');
    Route::get('/Roles/{id}/edit', 'RoleController@edit')->name('Roles.edit');
    Route::post('/Roles/', 'RoleController@store')->name('Roles.store');
    Route::put('/Roles/{id}', 'RoleController@update')->name('Roles.update');

    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::post('users', 'UserController@store')->name('users.store');
    Route::get('users/{id}/show', 'UserController@show')->name('users.show');
    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/update/{id}', 'UserController@update')->name('users.update');
    Route::delete('users/destroy/', 'UserController@destroy')->name('users.destroy');

    Route::get('Options', 'OptionController@index')->name('Options.index');
    Route::post('Options', 'OptionController@store')->name('Options.store');
    Route::get('Options/{id}/edit', 'OptionController@edit')->name('Options.edit');
    Route::put('Options/update/{id}', 'OptionController@update')->name('Options.update');
    Route::delete('Options/destroy/{id}', 'OptionController@destroy')->name('Options.destroy');

    Route::get('Expense', 'ExpenseController@index')->name('Expense.index');
    Route::get('getExpense', 'ExpenseController@getExpense')->name('Expense.getExpense');


    Route::get('Expense/create', 'ExpenseController@create')->name('Expense.create');
    Route::post('Expense', 'ExpenseController@store')->name('Expense.store');
    Route::get('Expense/print/pdf', 'ExpenseController@pdf')->name('Expense.print_Expense');

    Route::get('Expense/{id}/edit', 'ExpenseController@edit')->name('Expense.edit');
    Route::put('Expense/update/', 'ExpenseController@update')->name('Expense.update');
    Route::delete('Expense/destroy/{id}', 'ExpenseController@destroy')->name('Expense.destroy');


    Route::get('Settings/edit', 'SettingsController@edit')->name('Settings.edit');
   Route::put('Expense/update/{id}', 'SettingsController@update')->name('Settings.Update');


    Route::get('Profile/', 'ProfileController@Profile')->name('User.Profile');
    Route::put('Profile/{id}/Update/', 'ProfileController@UpdateProfile')->name('User.Profile.update');
    Route::get('changePassword/', 'ProfileController@changePassword')->name('User.Profile.password');
    Route::post('Profile/change-password', 'ProfileController@store')->name('User.change.password');
    Route::get('logout', 'ProfileController@logout')->name('admin.logout');


//    Route::get('users', 'UserController@index')->name('users.index');
//    Route::get('users/create', 'UserController@create')->name('users.create');
//    Route::post('users', 'UserController@store')->name('users.store');
//    Route::get('users/{id}/show', 'UserController@show')->name('users.show');
//    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
//    Route::put('users/update/{id}', 'UserController@update')->name('users.update');
//    Route::get('users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
//


});


Route::group(['namespace' => 'Customers\Auth', 'prefix' => 'Customers',], function () {
    Route::get('/login', 'LoginController@login')->name('Customers.login');
    Route::post('/login/', 'LoginController@postLogin')->name('postLogin');
});
Route::group(['namespace' => 'Customers', 'prefix' => 'Customers','middleware'=>'auth:customer'], function () {
    Route::get('Profile/', 'ProfileController@Profile')->name('Customer.Profile');
    Route::put('Profile/{id}/Update/', 'ProfileController@UpdateProfile')->name('Customer.Profile.update');
    Route::get('changePassword/', 'ProfileController@changePassword')->name('Customer.Profile.password');
    Route::post('Profile/change-password', 'ProfileController@store')->name('change.password');
    Route::get('logout', 'ProfileController@logout')->name('Customer.logout');
    Route::get('/Invoices/get_custom_invoice', 'InvoiceController@get_custom_invoice')->name('Customer.Invoices.get_customer_invoice');
    Route::get('/Invoices/', 'InvoiceController@index')->name('Customer.Invoices.index');
    Route::get('/Invoices/{id}/show', 'InvoiceController@show')->name('Customer.Invoices.show');

    Route::get('/Invoices/{id}/check', 'InvoiceController@checkInvoice')->name('Customer.Invoices.checkInvoice');

    Route::get('/Invoices/{id}/showPayment', 'InvoiceController@showPayment')->name('Customer.Payments.show');
    Route::get('/Payments/', 'PaymentController@index')->name('Customer.Payments.index');
    Route::get('/Payments/get_custom_payment', 'PaymentController@get_custom_payment')->name('Customer.Payments.get_customer_payment');
});


\Illuminate\Support\Facades\Auth::routes();

Route::get('/test', 'HomeController@index')->name('home');
