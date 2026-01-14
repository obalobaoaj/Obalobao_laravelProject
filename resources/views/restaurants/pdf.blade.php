<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111827; }
        h1 { font-size: 18px; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #e5e7eb; }
        th { background: #f3f4f6; text-align: left; font-weight: 700; }
        .muted { color: #6b7280; font-size: 11px; }
    </style>
</head>
<body>
    <h1>Restaurants Export</h1>
    <p class="muted">Generated at {{ now()->format('Y-m-d H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Cuisine</th>
                <th>Status</th>
                <th>Menu Items</th>
                <th>Prep Time (mins)</th>
                <th>Delivery Fee</th>
            </tr>
        </thead>
        <tbody>
            @forelse($restaurants as $restaurant)
                <tr>
                    <td>
                        <div>{{ $restaurant->name }}</div>
                        <div class="muted">{{ $restaurant->email ?? 'No email' }}</div>
                        <div class="muted">{{ $restaurant->address }}</div>
                    </td>
                    <td>{{ $restaurant->cuisine_type }}</td>
                    <td>{{ ucfirst($restaurant->status) }}</td>
                    <td>{{ $restaurant->menu_items_count }}</td>
                    <td>{{ $restaurant->avg_prep_time ?? '—' }}</td>
                    <td>₱{{ number_format($restaurant->delivery_fee, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No restaurants found for the current filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>



