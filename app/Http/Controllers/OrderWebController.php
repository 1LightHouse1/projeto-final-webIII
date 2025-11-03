<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderWebController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function show($id)
    {
        return view('orders.show', compact('id'));
    }
}

