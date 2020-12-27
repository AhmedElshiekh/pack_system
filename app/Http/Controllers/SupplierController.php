<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use App\Models\Supplier;
use Illuminate\Http\Request;



class SupplierController extends Controller
{



    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }


    public function create()
    {
        return view('suppliers.create');
    }


    public function store($locale ,Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'paid' => 'integer',
            'remaining' => 'integer',
            'note' => 'nullable|string',
        ]);
        Supplier::Create($request->all());
        return redirect()->route('supplier',$locale)->with('success',__('Supplier created successfully') );
    }


    public function show($locale, Supplier $supplier)
    {
        // $Supplier =Supplier::find($supplier);
        // dd($locale);
        return view('suppliers.show',compact('supplier'));
    }


    public function edit($locale, Supplier $supplier)
    {
        // dd($supplier);
        return view('suppliers.edit',compact('locale','supplier'));
    }



    public function update($locale, Request $request, Supplier $supplier)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|min:11',
            'address' => 'required|string',
            'note' => 'nullable|string',
        ]);
        $supplier->update($request->all());
        return redirect()->route('supplier',$locale)->with('success',__('Supplier updated successfully') );

    }





    public function destroy(Supplier $supplier)
    {

    }
}
