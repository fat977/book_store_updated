<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function books(){
        return $this->belongsToMany(PurchasedBook::class,'books_orders')
        ->withPivot('price','quantity');
    }

    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }
}
