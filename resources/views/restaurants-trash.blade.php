<x-layouts.app :title="__('Restaurants Trash')">
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark .glass-card { background: rgba(30, 30, 30, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); }
        .ios-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .ios-button { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; }
        .ios-button:active { transform: scale(0.97); }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-2xl p-2">
        @if (session('success'))
            <div class="rounded-2xl bg-gradient-to-r from-emerald-500 to-green-500 p-4 text-sm font-medium text-white shadow-lg" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="ios-card glass-card rounded-3xl p-6">
            <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-xl font-bold text-neutral-900 dark:text-white">Trash</h1>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Restore or permanently delete restaurants.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('restaurants.index') }}" class="ios-button rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 px-4 py-2 text-sm font-semibold text-white shadow">
                        ← Back to list
                    </a>
                </div>
            </div>

            <form method="GET" class="mb-4 grid gap-3 md:grid-cols-4 items-center">
                <div class="md:col-span-2">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Search name, email, or address"
                        class="w-full rounded-2xl border border-neutral-200 bg-white/80 px-4 py-3 text-sm shadow-sm focus:border-blue-400 focus:outline-none dark:border-neutral-700 dark:bg-neutral-800/80 dark:text-white" />
                </div>
                <select name="cuisine" class="rounded-2xl border border-neutral-200 bg-white/80 px-4 py-3 text-sm shadow-sm focus:border-blue-400 focus:outline-none dark:border-neutral-700 dark:bg-neutral-800/80 dark:text-white">
                    <option value="">All cuisines</option>
                    @foreach ($filters['cuisines'] as $option)
                        <option value="{{ $option }}" @selected($cuisine === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                <select name="status" class="rounded-2xl border border-neutral-200 bg-white/80 px-4 py-3 text-sm shadow-sm focus:border-blue-400 focus:outline-none dark:border-neutral-700 dark:bg-neutral-800/80 dark:text-white">
                    <option value="">All statuses</option>
                    @foreach ($filters['statuses'] as $option)
                        <option value="{{ $option }}" @selected($status === $option)>{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
                <div class="flex gap-3 md:col-span-2">
                    <button type="submit" class="ios-button flex-1 rounded-2xl bg-neutral-900 px-4 py-3 text-sm font-semibold text-white shadow hover:bg-neutral-800">
                        Apply filters
                    </button>
                    <a href="{{ route('restaurants.trash') }}" class="ios-button rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-neutral-700 shadow hover:bg-neutral-50 dark:bg-neutral-800 dark:text-neutral-100">
                        Clear
                    </a>
                </div>
            </form>

            <div class="overflow-auto rounded-2xl">
                <table class="w-full min-w-full">
                    <thead>
                        <tr class="border-b border-neutral-200/50 bg-white/60 backdrop-blur-sm dark:border-neutral-700/50 dark:bg-neutral-800/30">
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Profile</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Name</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Cuisine</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Status</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Menu Items</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Deleted At</th>
                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($restaurants as $restaurant)
                            <tr class="border-b border-neutral-100/50 dark:border-neutral-800/50">
                                <td class="px-5 py-4">
                                    @if($restaurant->photo_url)
                                        <img src="{{ $restaurant->photo_url }}" alt="{{ $restaurant->name }}" class="h-12 w-12 rounded-full object-cover shadow-md ring-2 ring-white dark:ring-neutral-800">
                                    @else
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-purple-600 text-sm font-bold text-white shadow-md ring-2 ring-white dark:ring-neutral-800">
                                            {{ strtoupper(mb_substr($restaurant->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="text-sm font-semibold text-neutral-900 dark:text-white">{{ $restaurant->name }}</div>
                                    <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">{{ $restaurant->address }}</p>
                                    <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">{{ $restaurant->email ?? 'No email' }} · {{ $restaurant->phone ?? 'No phone' }}</p>
                                </td>
                                <td class="px-5 py-4 text-sm font-medium text-neutral-600 dark:text-neutral-300">{{ $restaurant->cuisine_type }}</td>
                                <td class="px-5 py-4 text-sm">{{ ucfirst($restaurant->status) }}</td>
                                <td class="px-5 py-4 text-sm font-bold text-neutral-900 dark:text-white">{{ $restaurant->menu_items_count }}</td>
                                <td class="px-5 py-4 text-sm text-neutral-500 dark:text-neutral-400">{{ $restaurant->deleted_at?->format('Y-m-d H:i') }}</td>
                                <td class="px-5 py-4 text-sm">
                                    <div class="flex items-center gap-3">
                                        <form method="POST" action="{{ route('restaurants.restore', $restaurant->id) }}">
                                            @csrf
                                            <button type="submit" class="ios-button rounded-xl bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-600 transition-all hover:bg-emerald-500/20 dark:text-emerald-400">
                                                Restore
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('restaurants.force-delete', $restaurant->id) }}" onsubmit="return confirm('Permanently delete this restaurant? This cannot be undone.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ios-button rounded-xl bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-600 transition-all hover:bg-red-500/20 dark:text-red-400">
                                                Delete forever
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center">
                                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Trash is empty.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>

