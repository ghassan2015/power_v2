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
Route::group(['namespace' => 'Dashboard', 'prefix' => 'Dashboard'], function () {
    Route::get('/Customers', 'CustomerController@index')->name('Customers.index');
    Route::get('/Customers/Create', 'CustomerController@create')->name('Customers.create');
    Route::get('/Customers/{id}/edit', 'CustomerController@edit');
    Route::post('/Customers', 'CustomerController@Store')->name('Customers.Store');
    Route::get('/Customers/Subtype/{id}', 'CustomerController@getType');
    Route::put('/Customers/{id}', 'CustomerController@update')->name('Customers.update');
    Route::delete('/destroy/', 'CustomerController@destroy')->name('Customers.destroy');

    Route::get('/Invoices/', 'InvoiceController@index')->name('Invoices.index');
    Route::get('/Invoices/get_custom_invoice', 'InvoiceController@get_custom_invoice')->name('Invoices.get_custom_invoice');
    Route::get('/Invoices/Create', 'InvoiceController@create')->name('Invoices.create');
    Route::post('/Invoices/', 'InvoiceController@store')->name('Invoices.store');
    Route::get('/Invoices/Customer/{id}', 'InvoiceController@getInvoice')->name('Invoices.getInvoice');
    Route::get('/Invoices/{id}/show', 'InvoiceController@show')->name('Invoices.show');
    Route::get('/Invoices/{id}/edit', 'InvoiceController@edit')->name('Invoices.edit');
    Route::put('/Invoices/{id}/', 'InvoiceController@update')->name('Invoices.update');
    Route::delete('/Invoices//', 'InvoiceController@destroy')->name('Invoices.destroy');


    Route::get('/Payments/', 'PaymentController@index')->name('Payments.index');

    Route::get('/Payments/get_custom_payment', 'PaymentController@get_custom_payment')->name('Payments.get_custom_payment');
    Route::get('/Payments/{id}/show', 'PaymentController@show')->name('Payments.show');
    Route::post('/Payments/', 'PaymentController@store')->name('Invoices.payment.store');
    Route::put('/Payments/', 'PaymentController@update')->name('Payments.update');

    Route::get('/Roles/', 'RoleController@index')->name('Roles.index');
    Route::get('/Roles/Create', 'RoleController@create')->name('Roles.create');
    Route::get('/Roles/{id}/show', 'RoleController@show')->name('Roles.show');
    Route::get('/Roles/{id}/edit', 'RoleController@edit')->name('Roles.edit');
    Route::post('/Roles/', 'RoleController@store')->name('Roles.store');
    Route::put('/Roles/', 'RoleController@update')->name('Roles.update');

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
    Route::get('Expense/create', 'ExpenseController@create')->name('Expense.create');
    Route::post('Expense', 'ExpenseController@store')->name('Expense.store');
    Route::get('Expense/{id}/edit', 'ExpenseController@edit')->name('Expense.edit');
    Route::put('Expense/update/{id}', 'ExpenseController@update')->name('Expense.update');
    Route::delete('Expense/destroy/{id}', 'ExpenseController@destroy')->name('Expense.destroy');

    Route::get('Profile/', 'ProfileController@Profile')->name('User.Profile');
    Route::put('Profile/{id}/Update/', 'ProfileController@UpdateProfile')->name('User.Profile.update');
    Route::get('changePassword/', 'ProfileController@changePassword')->name('User.Profile.password');
    Route::post('Profile/change-password', 'ProfileController@store')->name('change.password');
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
//Route::post('/', function () {
//    return view('Pages.Dashboard.Customers.create');
//});
//Route::get('/', function () {
//    return view('Pages.Dashboard.Customers.create');
//});

//Route::get('/test', function () {
//    $customer= \App\Models\Customer::find(1);
//    return $customer->Subtype;
//});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
