<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;

class ProductController extends Controller{
    public function getIndex(){
        view('product');
    }
}