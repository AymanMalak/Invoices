<?php

namespace App\Http\Controllers;

use App\invoice_attachments;
use App\invoices;
use App\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $invoice = invoices::where('id','=',$id)->first();
            $inv_details= invoices_details::where('id_invoice','=',$id)->get();
            $inv_attatchments= invoice_attachments::where('invoice_id','=',$id)->get();
            return view('invoices.details_invoice',compact('inv_details','invoice','inv_attatchments'));

    }









    public function show_file($invoice_number,$file_name)
    {
        $file =Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($file);
    }




    public function download_file($invoice_number,$file_name)
    {
        $file =Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download($file);

    }











    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.  
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoice_attach =  invoice_attachments::findOrFail($request->id);
        // return $invoice_attach;
        $invoice_attach->delete();
        $file =Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('Delete','file deleted successfully');
        return back();
    }
}
