<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['total','number','type','return','paid','remaining','supplier_id','customer_id','user_id','note','due_date'];

    /* ************ Relation *********** */
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function item()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity','price','weight','total','name')->withTimestamps();
    }
}
