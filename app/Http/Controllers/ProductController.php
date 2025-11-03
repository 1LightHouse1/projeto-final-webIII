<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Produtos listados com sucesso',
            'data' => $products
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-products');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Product::create($validated);
        $product->load('category');

        return response()->json([
            'status' => 'success',
            'message' => 'Produto criado com sucesso',
            'data' => $product
        ], 201);
    }

    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Produto encontrado',
            'data' => $product
        ]);
    }

    public function update(Request $request, string $id)
    {
        Gate::authorize('manage-products');

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'category_id' => 'sometimes|exists:categories,id'
        ]);

        $product->update($validated);
        $product->load('category');

        return response()->json([
            'status' => 'success',
            'message' => 'Produto atualizado com sucesso',
            'data' => $product
        ]);
    }

    public function destroy(string $id)
    {
        Gate::authorize('manage-products');

        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produto excluído com sucesso',
            'data' => null
        ]);
    }
}
