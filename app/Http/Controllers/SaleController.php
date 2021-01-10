<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Paid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Voucher;

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
    public function store($locale, Request $request)
    {
        $invoice = new Invoice();
        $invoice->type = 'sale';
        // dd($invoice->type);
        $lastInvoice = Invoice::where('type', $invoice->type)->latest()->first();
        $type = $invoice->type == 'purchase' ? 'Out' : 'In';

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


        // $paid = new Paid();
        // $paid->name = "الدفعة الأولي" ;
        // $paid->invoice_id = $invoice->id ;
        // $paid->paid = $request->input('paid');
        // $paid->save();
        if($invoice->paid > 0){
            $voucher = new Voucher();
            $voucher->type = 'import';

            $lastVoucher = Voucher::where('type', $voucher->type)->latest()->first();
            $type = $voucher->type == 'export' ? 'out' : 'in';
            if ($lastVoucher) {
                $lastNumber =   $lastVoucher->number;
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

            $voucher->number =  $number;
            // $voucher->user = auth()->user()->name;
            $voucher->amount = $request->input('paid');
            // $voucher->to = $request->input('to');
            $voucher->customer_id = $request->input('customer_id');

            $voucher->paid_for = $invoice->number.' فاتوره بيع رقم ';
            $voucher->note = $request->input('note');
            // $voucher->pay_date = $request->input('pay_date');
            $voucher->save();
        }
        $customer = Customer::find($invoice->customer_id);
        $customer->paid += $request->input('paid');
        $customer->remaining += $request->input('remaining');
        $customer->save();


        $itemLoop = $request->input('item_count');
        for ($i = 1; $i <= $itemLoop; $i++) {

            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->name = $request->input('item_name_'.$i);
            $item->quantity = $request->input('item_quantity_'.$i);
            $item->price = $request->input('item_price_'.$i);
            $item->total = $request->input('item_total_'.$i);
            $item->save();
        }

        return redirect()->route('sales',$locale)->with('success','Invoice Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show( $locale, Invoice $invoice)
    {
        $items = Item::where('invoice_id', $invoice->id)->get();
        $paids = Paid::where('invoice_id', $invoice->id)->get();

        return view('invoice.sales.show', compact('invoice','items','paids','locale'));

    }


    public function paid($locale ,Invoice $invoice ,Request $request )
    {
        $paid = new Paid();
        $paid->invoice_id = $invoice->id ;
        $paid->paid = $request->input('paid');
        $paid->name = $request->input('name');
        $paid->save();

        $invoice->paid += $paid->paid;
        $invoice->remaining -= $paid->paid;
        $invoice->save();

        return redirect()->route('sales.show',[$locale ,$invoice])->with('success','Invoice Created Successfully');

    }



    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($invoice)
    // {
    //     $invoice_del = Invoice::find($invoice);
    //     $invoice_del->delete();
    //     return redirect()->back()->with('success', 'invoice deleted successfully');
    // }
    public function destroy( $locale,Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('sales',$locale)->with('success', 'invoice deleted successfully');
    }



}
