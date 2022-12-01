<?php

namespace App\Http\Controllers;

use App\invoices;
use App\invoices_details;
use App\invoice_attachments;
use App\Mail\AddInvoice ;
use App\sections;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// use App\Notifications\addInvoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
// use App\Mail\AddInvoice;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view("invoices.invoices", compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo "Asdasdasdsad";
        $sections = sections::all();
        return view("invoices.add_invoice", compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => 'غير مدفوعة',
            'value_status' => 0,
            'note' => $request->note,
        ]);

        // return $request;
        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => 'غير مدفوعة',
            'value_status' => 0,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {
            // $this->validate($request, [
            //     'pic' => 'required|mimes:pdf|max:10000',

            // ], [
            //     'pic.mimes' => 'the invoice saved but the attachment should be pdf',
            // ]);

            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            //move pic
            $image_name = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('attachments/' . $invoice_number), $image_name);
        }

        session()->flash('add_invoice', 'Invoice Added Successfully');

        $email = Auth::user()->email;

        Mail::to($email)->send(new AddInvoice($email));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $invoice = invoices::where('id', $id)->first();
        $sections = sections::all();
        return view('invoices.edit_invoice', compact('invoice', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoices = invoices::findOrFail($request->invoice_id);
        // return $request;
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => 'غير مدفوعة',
            'value_status' => 0,
            'note' => $request->note,
        ]);

        session()->flash('edit_invoice', 'invoice updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = invoices::where('id', $id)->first();
        $details = invoice_attachments::where('invoice_id', $request->invoice_id)->first();
        // return $details->invoice_number;
        if (!empty($details->invoice_number)) {

            Storage::disk('public_uploads')->deleteDirectory($details->invoice_number); // delete folder
            // Storage::disk('public_uploads')->delete($details->invoice_number.'/'.$details->file_name); // delete file in folder

        }
        // $invoice->Delete(); //soft delete , byb2a feh copy fel database k2ne b3mlha "archive"
        $invoice->forceDelete(); // delete Permanently nha2yn 7ta mn aldatabase
        session()->flash('delete_invoice', 'Invoice Deleted Successfully');
        return back();
    }

    public function getproducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }



    public function showstatus($id, Request $request)
    {

        $invoice = invoices::findOrFail($id);
        $sections = sections::all();
        return view("invoices.change_status", compact('invoice', 'sections'));
    }

    public function changestatus($id, Request $request)
    {

        $invoice = invoices::findOrFail($id);

        // return $request;
        if ($request->status == "مدفوعة") {

            invoices::findOrFail($id)->update([
                'value_status' => 1,
                'status' => "مدفوعة",
                'payment_date' => $request->payment_date,
            ]);

            invoices_details::create([
                'id_invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'value_status' => 1,
                'status' => "مدفوعة",
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);
        } else if ($request->status == "مدفوعة جزئيا") {

            invoices::findOrFail($id)->update([
                'value_status' => 2,
                'status' => "مدفوعة جزئيا",
                'payment_date' => $request->payment_date,
            ]);

            invoices_details::create([
                'id_invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'value_status' => 2,
                'status' => "مدفوعة جزئيا",
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('status_updated', 'status Updated Successfully');

        return redirect()->back();
    }





    public function invoicesPaid()
    {
        $invoices =  invoices::where('value_status', 1)->get();
        return view("invoices.invoices_paid", compact('invoices'));
    }

    public function invoicesUnpaid()
    {
        $invoices =  invoices::where('value_status', 0)->get();
        return view("invoices.invoices_unpaid", compact('invoices'));
    }

    public function invoicesPartial()
    {
        $invoices =  invoices::where('value_status', 2)->get();
        return view("invoices.invoices_partial", compact('invoices'));
    }


    public function printInvoice($id)
    {
        $invoice =  invoices::where('id', $id)->first();
        return view("invoices.print_invoice", compact('invoice'));
    }






    // archive invoices
    public function archiveInvoice(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = invoices::where('id', $id)->first();
        $invoice->delete();
        session()->flash('archive_invoice');
        return redirect("archived_invoices");
    }

    public function archivedInvoices (){
        $invoices =  invoices::onlyTrashed()->get();
        return view( "invoices.archive_invoice",compact('invoices') );
    }

    public function restoreInvoice (Request $request){
        $id=$request->invoice_id;
        $invoices= invoices::withTrashed()->where('id',$id)->restore();
        session()->flash('restore_invoice');
        return redirect( "invoices" );
    }

}
