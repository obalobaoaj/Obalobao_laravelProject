<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function index(): View
    {
        $restaurants = Restaurant::withCount('menuItems')->latest()->get();

        $stats = [
            'restaurants' => $restaurants->count(),
            'open' => $restaurants->where('status', 'open')->count(),
            'averagePrep' => $restaurants->avg('avg_prep_time'),
        ];

        return view('restaurants', compact('restaurants', 'stats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:restaurants,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'required|string|max:100',
            'delivery_fee' => 'nullable|numeric|min:0|max:9999.99',
            'avg_prep_time' => 'nullable|integer|min:5|max:240',
            'status' => 'required|in:open,closed,paused',
        ]);

        Restaurant::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'],
            'cuisine_type' => $validated['cuisine_type'],
            'delivery_fee' => $validated['delivery_fee'] ?? 0,
            'avg_prep_time' => $validated['avg_prep_time'] ?? 20,
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Restaurant saved successfully.');
    }

    public function update(Request $request, Restaurant $restaurant): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('restaurants', 'email')->ignore($restaurant->id),
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'required|string|max:100',
            'delivery_fee' => 'nullable|numeric|min:0|max:9999.99',
            'avg_prep_time' => 'nullable|integer|min:5|max:240',
            'status' => 'required|in:open,closed,paused',
        ]);

        $restaurant->update([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'],
            'cuisine_type' => $validated['cuisine_type'],
            'delivery_fee' => $validated['delivery_fee'] ?? 0,
            'avg_prep_time' => $validated['avg_prep_time'] ?? 20,
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Restaurant updated successfully.');
    }

    public function destroy(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->delete();

        return back()->with('success', 'Restaurant deleted successfully.');
    }
}
