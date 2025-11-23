<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiderController extends Controller
{
    public function dashboard(): View
    {
        $rider = auth()->user();
        
        $availableOrders = Order::where('status', 'ready')
            ->whereNull('rider_id')
            ->with(['restaurant', 'orderItems.menuItem'])
            ->latest()
            ->get();

        $myOrders = Order::where('rider_id', $rider->id)
            ->whereIn('status', ['assigned', 'picked_up', 'in_transit'])
            ->with(['restaurant', 'orderItems.menuItem'])
            ->latest()
            ->get();

        $completedOrders = Order::where('rider_id', $rider->id)
            ->where('status', 'delivered')
            ->with(['restaurant'])
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'available' => $availableOrders->count(),
            'active' => $myOrders->count(),
            'completed' => Order::where('rider_id', $rider->id)->where('status', 'delivered')->count(),
            'earnings' => Order::where('rider_id', $rider->id)
                ->where('status', 'delivered')
                ->sum('delivery_fee'),
        ];

        return view('rider.dashboard', compact('availableOrders', 'myOrders', 'completedOrders', 'stats'));
    }

    public function acceptOrder(Order $order): RedirectResponse
    {
        if ($order->status !== 'ready' || $order->rider_id !== null) {
            return back()->with('error', 'This order is no longer available.');
        }

        $order->update([
            'rider_id' => auth()->id(),
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);

        auth()->user()->update(['status' => 'on_delivery']);

        return back()->with('success', 'Order accepted successfully!');
    }

    public function updateStatus(Order $order, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:picked_up,in_transit,delivered',
        ]);

        $updateData = ['status' => $validated['status']];

        if ($validated['status'] === 'picked_up') {
            $updateData['picked_up_at'] = now();
        } elseif ($validated['status'] === 'delivered') {
            $updateData['delivered_at'] = now();
            auth()->user()->update(['status' => 'active']);
        }

        $order->update($updateData);

        return back()->with('success', 'Order status updated successfully!');
    }

    public function history(): View
    {
        $orders = Order::where('rider_id', auth()->id())
            ->where('status', 'delivered')
            ->with(['restaurant', 'orderItems'])
            ->latest()
            ->paginate(15);

        $totalEarnings = Order::where('rider_id', auth()->id())
            ->where('status', 'delivered')
            ->sum('delivery_fee');

        return view('rider.history', compact('orders', 'totalEarnings'));
    }
}
