<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','phone','address','note','paid','remaining'
    ];

    /********** Relation ******* */
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }


}
