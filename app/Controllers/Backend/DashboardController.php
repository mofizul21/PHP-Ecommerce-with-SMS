<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;

class DashboardController extends Controller{
    public function getIndex(){
        $this->view('dashboard');
    }
}