<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','phone','whatsApp','NationalID','note','paid','remaining','address'];

    function invoices(){
        return $this->hasMany(Invoice::class);
    }
    // function vouchers(){
    //     return $this->hasMany(Voucher::class);
    // }
    // function perishables(){
    //     return $this->hasMany(Perishable::class);
    // }
}
