<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=['id','payment_value','invoice_id','created_at','updated_at'];

public function Invoice(){
    return $this->belongsTo(Invoice::class,'invoice_id');

}
    public function User(){
    return $this->belongsTo(User::class,'user_id');
    }

}
