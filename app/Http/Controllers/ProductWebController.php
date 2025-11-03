<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function show($id)
    {
        return view('products.show', compact('id'));
    }

    public function edit($id)
    {
        return view('products.edit', compact('id'));
    }
}
