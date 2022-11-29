<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', 'HomeController@index')->name('home');


Auth::routes();
// Auth::routes(['register' => false]);


Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('invoices','InvoicesController');
    Route::resource('sections','SectionsController');
    Route::resource('products','ProductsController');

    Route::get('/invoices_paid','InvoicesController@invoicesPaid')->name('invoices_paid');
    Route::get('/invoices_unpaid','InvoicesController@invoicesUnpaid')->name('invoices_unpaid');
    Route::get('/invoices_partial','InvoicesController@invoicesPartial')->name('invoices_partial');

    
    Route::get('/show_status/{id}','InvoicesController@showStatus')->name('show_status');
    Route::post('/statusUpdate/{id}','InvoicesController@changeStatus')->name('Invoices.statusUpdate');
    // Route::get('/change_status/{id}','InvoicesController@changeStatus')->name('change_status');
    
    Route::post('/invoiceAttachments','InvoiceAttachmentsController@store')->name('invoiceAttachments.store');
    
    Route::get('/edit_invoice/{id}','InvoicesController@edit')->name('edit_invoice');
    Route::post('/update_invoice','InvoicesController@update')->name('invoices.update');
    Route::delete('/delete_invoice','InvoicesController@destroy')->name('invoices.destroy');
    
    Route::delete('/archive_invoice','InvoicesController@archiveInvoice')->name('archive_invoice');
    
    Route::get('/archived_invoices','InvoicesController@archivedInvoices')->name('archived_invoices');

    Route::get('/print_invoice/{id}','InvoicesController@printInvoice')->name('print_invoice');

    Route::patch('/restore_invoice','InvoicesController@restoreInvoice')->name('restore_invoice');
    

    Route::get('/section/{id}','InvoicesController@getproducts');
    Route::get('/invoicesDetails/{id}','InvoicesDetailsController@edit');
    Route::get('/view_file/{invoice_number}/{file_name}','InvoicesDetailsController@show_file');
    Route::get('/download_file/{invoice_number}/{file_name}','InvoicesDetailsController@download_file');
    Route::post('delete_file','InvoicesDetailsController@destroy')->name('delete_file');

    Route::get('/{page}', 'AdminController@index');

});

