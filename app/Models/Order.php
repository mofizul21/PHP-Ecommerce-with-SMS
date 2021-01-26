<?php

namespace App\Models;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    protected $guarded = [];

    public $timestamps = false;

    public function products(){
        return $this->hasMany(OrderProduct::class);
    }
}