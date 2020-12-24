<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Notifications\Events\NotificationSent;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            $invoices = Invoice::where('type', 'purchase')->with('supplier')->get();
        } else {
            $invoices = Invoice::where('type', 'purchase')->with('supplier')->get()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 24:00:00']);
        }

        return view('invoice.purchase.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $suppliers = Supplier::all()->pluck('name', 'id');
        return view('invoice.purchase.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $invoice = new Invoice();
        $invoice->type = 'purchase';
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
        $invoice->supplier_id = $request->input('supplier_id');
        $invoice->total = $request->input('total');
        $invoice->paid = $request->input('paid');
        $invoice->remaining = $request->input('remaining');
        $invoice->note = $request->input('note');
        $invoice->due_date = $request->input('due_date');
        $invoice->save();


        $supplier = Supplier::find($invoice->supplier_id);
        $supplier->paid += $request->input('paid');
        $supplier->remaining += $request->input('remaining');
        $supplier->save();


        $itemLoop = $request->input('item_count');
        for ($i = 1; $i <= $itemLoop; $i++) {
            
            $item = new Item();
            $item->invoice_id = $invoice->id;
            // dd($item->invoice_id);
            $item->name = $request->input('item_name_'.$i);
            $item->quantity = $request->input('item_quantity_'.$i);
            $item->weight = $request->input('item_weight_'.$i);
            $item->Price = $request->input('item_price_'.$i);
            $item->save();

        }



        return redirect()->route('purchase')->with('success', 'Invoice Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoice.purchase.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Invoice $invoice)
    {
        //
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