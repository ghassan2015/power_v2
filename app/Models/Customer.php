<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guarded=[];
    //

    public function Subtype(){
        return $this->belongsTo(Subtype::class,'subtype_id');
    }
    public function Invoice(){
        return $this->hasMany(Invoice::class,'customer_id');
    }
}
