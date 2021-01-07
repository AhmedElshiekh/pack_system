<?php

namespace App\Http\Controllers;
use App\Models\Supplier;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            $vouchers = Voucher::where('type', 'export')->get();
        } else {
            $vouchers = Voucher::where('type', 'export')->get()->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 24:00:00']);
        }

        return view('vouchers.exports.index', compact('vouchers'));
    }


    public function create()
    {
        $suppliers = Supplier::all()->pluck('name', 'id');
        return view('vouchers.exports.create',compact('suppliers'));
    }

    public function store($locale ,Request $request)
    {
        $voucher = new Voucher();
        $voucher->type = 'export';

        $lastVoucher = Voucher::where('type', $voucher->type)->latest()->first();
        $type = $voucher->type == 'export' ? 'out' : 'in';
        if ($lastVoucher) {
            $lastNumber = $lastVoucher->number;
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
        $voucher->supplier_id = $request->input('supplier_id');

        $voucher->paid_for = $request->input('paid_for');
        $voucher->note = $request->input('note');
        $voucher->pay_date = $request->input('pay_date');
        $voucher->save();
        if ($voucher->supplier){
            $voucher->supplier->paid += $voucher->amount;
            $voucher->supplier->remaining -= $voucher->amount;
            $voucher->supplier->save();
        }
        return redirect()->route('exports',$locale)->with('success', 'Voucher Created Successfully');
    }



    public function show($locale ,Voucher $voucher)
    {
        return view('vouchers.exports.show',compact('voucher' ,'locale'));
    }



    public function edit(Voucher $Voucher)
    {
        //
    }


    public function destroy($locale, $voucher)
    {
        $voucher->delete();
        return redirect()->route('exports',$locale)->with('success', 'Voucher deleted successfully');
    }



}
