<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'invoice_id','paid'];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('invoice_id','paid','name')->withTimestamps();
    }
}
