<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-categories');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, string $id)
    {
        Gate::authorize('manage-categories');

        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    public function destroy(string $id)
    {
        Gate::authorize('manage-categories');

        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Categoria excluída com sucesso']);
    }
}
