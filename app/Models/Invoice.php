<?php

namespace App\Models;

use App\Payment;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table='invoices';
    protected $guarded=[];
    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');


    }
    public function Payment(){
        return $this->hasMany(\App\Models\Payment::class,'invoice_id');
    }

}
