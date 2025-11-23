<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['restaurant', 'rider', 'orderItems.menuItem'])
            ->latest()
            ->paginate(20);

        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'ready' => Order::where('status', 'ready')->count(),
            'in_transit' => Order::where('status', 'in_transit')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
        ];

        return view('orders.index', compact('orders', 'stats'));
    }

    public function create(): View
    {
        $restaurants = Restaurant::where('status', 'open')->with('menuItems')->get();
        return view('orders.create', compact('restaurants'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:1000',
        ]);

        $restaurant = Restaurant::findOrFail($validated['restaurant_id']);
        
        // Calculate subtotal before creating the order
        $subtotal = 0;
        $menuItemsData = [];
        foreach ($validated['items'] as $item) {
            $menuItem = MenuItem::findOrFail($item['menu_item_id']);
            $itemSubtotal = $menuItem->price * $item['quantity'];
            $subtotal += $itemSubtotal;
            
            $menuItemsData[] = [
                'menuItem' => $menuItem,
                'item' => $item,
                'itemSubtotal' => $itemSubtotal,
            ];
        }
        
        $order = Order::create([
            'restaurant_id' => $validated['restaurant_id'],
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'delivery_address' => $validated['delivery_address'],
            'subtotal' => $subtotal,
            'delivery_fee' => $restaurant->delivery_fee,
            'total' => $subtotal + $restaurant->delivery_fee,
            'notes' => $validated['notes'] ?? null,
            'status' => 'confirmed',
        ]);

        // Create order items
        foreach ($menuItemsData as $data) {
            $order->orderItems()->create([
                'menu_item_id' => $data['item']['menu_item_id'],
                'item_name' => $data['menuItem']->name,
                'price' => $data['menuItem']->price,
                'quantity' => $data['item']['quantity'],
                'subtotal' => $data['itemSubtotal'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function updateStatus(Order $order, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,preparing,ready,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Order status updated successfully!');
    }
}
