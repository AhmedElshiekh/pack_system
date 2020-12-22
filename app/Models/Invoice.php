<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['total','number','type','return','paid','remaining','supplier_id','customer_id','user_id','note'];

    // public function items()
    // {
    //     return $this->belongsToMany(Item::class, 'invoice_item')->withPivot('quantity','price','warehouse_id','weight','total','name')->withTimestamps();
    // }
    // public function products()
    // {
    //     return $this->belongsToMany(Production::class, 'invoice_products','invoice_id','product_id')->withPivot('quantity','price','total','name')->withTimestamps();
    // }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
