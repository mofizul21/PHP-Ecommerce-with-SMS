<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $guarded = [];

    public $timestamps = false;

    public function product_photo(){
        return $this->hasOne(ProductImage::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}