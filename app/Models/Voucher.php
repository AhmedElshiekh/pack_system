<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = ['number','amount','type','note','supplier_id','customer_id','to','paid_for','pay_date'];
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
