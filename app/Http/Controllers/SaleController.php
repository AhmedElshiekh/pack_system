<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SaleController extends Controller
{

    public function index(Request $request)
    {
        if ($request->method() == 'GET'){
            $invoices=Invoice::where('type','sale')->with('customer')->get();
        }else{
            $invoices=Invoice::where('type','sale')->with('customer')->get()->whereBetween('created_at',[$request->from.' 00:00:00',$request->to.' 24:00:00']);
        }
        return view('invoice.sales.index',compact('invoices'));

    }
    

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all()->pluck('name','id');
        return view('invoice.sales.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new Invoice();
        $invoice->type = 'sale';
        // dd($invoice->type);
        $lastInvoice = Invoice::where('type', $invoice->type)->latest()->first();
        $type = $invoice->type == 'purchase' ? 'out' : 'in';

        if ($lastInvoice) {
            $lastNumber =   $lastInvoice->number;
            if (Str::contains($lastNumber, $type . '-' . Date('y') . Date('m'))) {
                $num = Str::after($lastNumber, Date('y') . Date('m'));
                $new = str_pad($num + 1, 4, '0', STR_PAD_LEFT);
                $number = $type . '-' . Date('y') . Date('m') . $new;
            } else {
                $number = $type . '-' . Date('y') . Date('m') . '0001';
            }
        } else {
            $number = $type . '-' . Date('y') . Date('m') . '0001';
        }
        $invoice->number =  $number;
        // $invoice->user = auth()->user()->name;
        $invoice->customer_id = $request->input('customer_id');
        $invoice->total = $request->input('total');
        $invoice->paid = $request->input('paid');
        $invoice->remaining = $request->input('remaining');
        $invoice->note = $request->input('note');
        $invoice->due_date = $request->input('due_date');
        $invoice->save();


        $customer = Customer::find($invoice->customer_id);
        $customer->paid += $request->input('paid');
        $customer->remaining += $request->input('remaining');
        $customer->save();


        $itemLoop = $request->input('item_count');
        for ($i = 1; $i <= $itemLoop; $i++) {
            
            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->name = $request->input('item_name_'.$i);
            // dd($item->name);
            $item->quantity = $request->input('item_quantity_'.$i);
            $item->Price = $request->input('item_price_'.$i);
            $item->save();

        }

        return redirect()->route('sales')->with('success','Invoice Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {

        return view('invoice.sales.show',compact('invoice'));

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($invoice)
    {
        $invoice_del = Invoice::find($invoice);
        $invoice_del->delete();
        return redirect()->back()->with('success', 'invoice deleted successfully');
    }


    
}
