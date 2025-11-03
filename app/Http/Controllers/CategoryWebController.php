<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryWebController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function show($id)
    {
        return view('categories.show', compact('id'));
    }

    public function edit($id)
    {
        return view('categories.edit', compact('id'));
    }
}

