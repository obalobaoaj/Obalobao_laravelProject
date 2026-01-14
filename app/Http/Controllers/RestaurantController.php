<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q')->toString();
        $status = $request->string('status')->toString();
        $cuisine = $request->string('cuisine')->toString();

        $restaurantsQuery = Restaurant::query()
            ->withCount('menuItems')
            ->when($search, fn ($query) => $query
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%");
                }))
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($cuisine, fn ($query) => $query->where('cuisine_type', $cuisine))
            ->latest();

        $restaurants = $restaurantsQuery->get();

        $stats = [
            'restaurants' => Restaurant::count(),
            'open' => Restaurant::where('status', 'open')->count(),
            'averagePrep' => Restaurant::avg('avg_prep_time'),
        ];

        $filters = [
            'cuisines' => Restaurant::select('cuisine_type')->distinct()->pluck('cuisine_type'),
            'statuses' => ['open', 'paused', 'closed'],
            'trashCount' => Restaurant::onlyTrashed()->count(),
        ];

        return view('restaurants', compact('restaurants', 'stats', 'filters', 'search', 'status', 'cuisine'));
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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'photo.image' => 'The photo must be an image file.',
            'photo.mimes' => 'The photo must be a JPG or PNG file.',
            'photo.max' => 'The photo must not be larger than 2MB.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('restaurants', 'public');
        }

        Restaurant::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'],
            'cuisine_type' => $validated['cuisine_type'],
            'delivery_fee' => $validated['delivery_fee'] ?? 0,
            'avg_prep_time' => $validated['avg_prep_time'] ?? 20,
            'status' => $validated['status'],
            'photo_path' => $photoPath,
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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'photo.image' => 'The photo must be an image file.',
            'photo.mimes' => 'The photo must be a JPG or PNG file.',
            'photo.max' => 'The photo must not be larger than 2MB.',
        ]);

        $photoPath = $restaurant->photo_path;
        
        // Handle photo removal
        if ($request->input('remove_photo') == '1') {
            if ($restaurant->photo_path) {
                Storage::disk('public')->delete($restaurant->photo_path);
            }
            $photoPath = null;
        }
        
        // Handle new photo upload
        if ($request->hasFile('photo')) {
            if ($restaurant->photo_path) {
                Storage::disk('public')->delete($restaurant->photo_path);
            }
            $photoPath = $request->file('photo')->store('restaurants', 'public');
        }

        $restaurant->update([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'],
            'cuisine_type' => $validated['cuisine_type'],
            'delivery_fee' => $validated['delivery_fee'] ?? 0,
            'avg_prep_time' => $validated['avg_prep_time'] ?? 20,
            'status' => $validated['status'],
            'photo_path' => $photoPath,
        ]);

        return back()->with('success', 'Restaurant updated successfully.');
    }

    public function destroy(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->delete();

        return back()->with('success', 'Restaurant moved to trash.');
    }

    public function trash(Request $request): View
    {
        $search = $request->string('q')->toString();
        $status = $request->string('status')->toString();
        $cuisine = $request->string('cuisine')->toString();

        $restaurants = Restaurant::onlyTrashed()
            ->withCount('menuItems')
            ->when($search, fn ($query) => $query
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%");
                }))
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($cuisine, fn ($query) => $query->where('cuisine_type', $cuisine))
            ->latest()
            ->get();

        $filters = [
            'cuisines' => Restaurant::select('cuisine_type')->distinct()->pluck('cuisine_type'),
            'statuses' => ['open', 'paused', 'closed'],
        ];

        return view('restaurants-trash', compact('restaurants', 'filters', 'search', 'status', 'cuisine'));
    }

    public function restore(int $restaurantId): RedirectResponse
    {
        $restaurant = Restaurant::onlyTrashed()->findOrFail($restaurantId);
        $restaurant->restore();

        return back()->with('success', 'Restaurant restored successfully.');
    }

    public function forceDelete(int $restaurantId): RedirectResponse
    {
        $restaurant = Restaurant::onlyTrashed()->findOrFail($restaurantId);

        if ($restaurant->photo_path) {
            Storage::disk('public')->delete($restaurant->photo_path);
        }

        $restaurant->forceDelete();

        return back()->with('success', 'Restaurant permanently deleted.');
    }

    public function exportPdf(Request $request)
    {
        $search = $request->string('q')->toString();
        $status = $request->string('status')->toString();
        $cuisine = $request->string('cuisine')->toString();

        $restaurants = Restaurant::query()
            ->when($search, fn ($query) => $query
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%");
                }))
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($cuisine, fn ($query) => $query->where('cuisine_type', $cuisine))
            ->withCount('menuItems')
            ->orderBy('name')
            ->get();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = view('restaurants.pdf', ['restaurants' => $restaurants])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $timestamp = now()->format('Y-m-d_H-i-s');
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"restaurants_{$timestamp}.pdf\"",
        ]);
    }
}
