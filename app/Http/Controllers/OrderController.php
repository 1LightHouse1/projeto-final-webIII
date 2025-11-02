<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('orderItems.product')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $total = 0;

        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            $total += $product->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'status' => 'pending',
            'total' => $total
        ]);

        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price
            ]);
        }

        $order->load('orderItems.product');

        return response()->json($order, 201);
    }

    public function show(Request $request, string $id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        
        Gate::authorize('view', $order);

        return response()->json($order);
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        Gate::authorize('update', $order);

        $validated = $request->validate([
            'status' => 'sometimes|in:pending,processing,completed,cancelled'
        ]);

        $order->update($validated);

        return response()->json($order);
    }

    public function destroy(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        Gate::authorize('delete', $order);

        $order->delete();

        return response()->json(['message' => 'Pedido excluído com sucesso']);
    }
}
