<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api\Dashboard', 'prefix' => 'Dashboard'], function () {
    Route::get('/Customers', 'CustomerController@index');
    Route::post('/Customers/Store', 'CustomerController@store');
    Route::post('/Customers/Subtype/{id}', 'CustomerController@getType');
    Route::post('/Customers/update/', 'CustomerController@update');
    Route::delete('/Customers/delete', 'CustomerController@delete');

    Route::post('/Invoices/', 'InvoiceController@index');
    Route::post('/Invoices/store', 'InvoiceController@store')->name('Invoices.store');
    Route::get('/Invoices/Customer/{id}', 'InvoiceController@getInvoice')->name('Invoices.getInvoice');
    Route::get('/Invoices/{id}/show', 'InvoiceController@show')->name('Invoices.show');
    Route::get('/Invoices/{id}/edit', 'InvoiceController@edit')->name('Invoices.edit');
    Route::put('/Invoices/{id}/', 'InvoiceController@update')->name('Invoices.update');
    Route::delete('/Invoices/delete', 'InvoiceController@destroy')->name('Invoices.destroy');
    Route::get('Invoices/print/{id}', ['as' => 'invoice.print', 'uses' => 'InvoiceController@printt']);
    Route::get('Invoices/pdf/{id}', ['as' => 'invoice.pdf', 'uses' => 'InvoiceController@pdf']);


});
