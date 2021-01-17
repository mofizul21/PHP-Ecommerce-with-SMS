<?php

namespace App\Controllers\Frontend;

use App\Controllers\Controller;

class UsersController extends Controller
{
    public function getIndex()
    {
        $this->view('login');
    }

}
