<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerPagesController extends Controller{
    public function index(){
        $title = 'Welcome to 47 East';
        return view('customer.index')->with('title', $title);
    }
}
