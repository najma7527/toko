<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function allData1 (){
        Return View('Dashboard_Admin');
    }

    public function allData2 (){
        Return View('Dashboard_Kasir');
    }
}
