<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($locale, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|min:11',
            'address' => 'nullable|string',
            'paid' => 'integer',
            'remaining' => 'integer',
            'note' => 'nullable|string',
        ]);
        Customer::Create($request->all());
        return redirect()->route('customer',$locale)->with('success', __('Customer created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($locale,Customer $customer)
    {
        $items = Item::all();
        $vouchers = Voucher::where('customer_id' , $customer->id)->get();
        return view('customers.show', compact('customer','items','vouchers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, Customer $customer)
    {
        return view('customers.edit', compact('locale','customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update($locale, Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string|min:11',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
        ]);
        $customer->update($request->all());
        return redirect()->route('customer',$locale)->with('success', __('Customer updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
