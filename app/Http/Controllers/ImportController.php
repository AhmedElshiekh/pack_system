<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            $vouchers = Voucher::where('type', 'import')->get();
        } else {
            $vouchers = Voucher::where('type', 'import')->get()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 24:00:00']);
        }

        return view('vouchers.imports.index', compact('vouchers'));
    }

    public function create()
    {
        // $suppliers = Supplier::all()->pluck('name', 'id');
        $customers = Customer::all()->pluck('name','id');
        return view('vouchers.imports.create', compact('customers'));
    }

    public function store($locale ,Request $request)
    {
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
        $voucher->amount = $request->input('amount');
        // $voucher->to = $request->input('to');
        $voucher->customer_id = $request->input('customer_id');

        $voucher->paid_for = $request->input('paid_for');
        $voucher->note = $request->input('note');
        $voucher->pay_date = $request->input('pay_date');
        $voucher->save();
        if ($voucher->customer){
            $voucher->customer->paid += $voucher->amount;
            $voucher->customer->remaining -= $voucher->amount;
            $voucher->customer->save();
        }
        return redirect()->route('imports',$locale)->with('success', 'Voucher Created Successfully');
    }


    public function show($locale ,Voucher $voucher)
    {
        return view('vouchers.imports.show',compact('voucher', 'locale'));
    }



    public function edit(Voucher $Voucher)
    {
        //
    }


    public function destroy($locale, $voucher)
    {
        $voucher->delete();
        return redirect()->route('imports',$locale)->with('success', 'Voucher deleted successfully');
    }



}
