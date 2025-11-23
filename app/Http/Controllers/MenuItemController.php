<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    public function index(): View
    {
        $menuItems = MenuItem::with('restaurant')->latest()->get();
        $restaurants = Restaurant::orderBy('name')->get();

        $stats = [
            'menuItems' => $menuItems->count(),
            'restaurants' => $restaurants->count(),
            'openRestaurants' => $restaurants->where('status', 'open')->count(),
        ];

        return view('dashboard', compact('menuItems', 'restaurants', 'stats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'restaurant_id' => $request->filled('restaurant_id') ? $request->restaurant_id : null,
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0|max:9999.99',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['restaurant_id'] = $validated['restaurant_id'] ?? null;
        $validated['is_available'] = $request->boolean('is_available', true);

        MenuItem::create($validated);

        return back()->with('success', 'Menu item added successfully.');
    }

    public function update(Request $request, MenuItem $menuItem): RedirectResponse
    {
        $request->merge([
            'restaurant_id' => $request->filled('restaurant_id') ? $request->restaurant_id : null,
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0|max:9999.99',
            'restaurant_id' => 'nullable|exists:restaurants,id',
            'is_available' => 'required|boolean',
        ]);

        $validated['restaurant_id'] = $validated['restaurant_id'] ?? null;
        $validated['is_available'] = (bool) $validated['is_available'];

        $menuItem->update($validated);

        return back()->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();

        return back()->with('success', 'Menu item deleted successfully.');
    }
}

