<x-layouts.app :title="__('Restaurant & Delivery Dashboard')">
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.4s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        .animate-scale-in {
            animation: scaleIn 0.3s ease-out;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass-card {
            background: rgba(30, 30, 30, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .ios-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .dark .ios-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
        }

        .ios-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .dark .ios-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
        }

        .ios-button {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .ios-button:active {
            transform: scale(0.97);
        }

        .ios-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .ios-button:active::before {
            width: 300px;
            height: 300px;
        }

        dialog::backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .stat-card-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover .stat-card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .dark .table-row:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        input, select, textarea {
            transition: all 0.2s ease;
        }

        input:focus, select:focus, textarea:focus {
            transform: scale(1.01);
        }
    </style>

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-2xl p-2">
        @if (session('success'))
            <div class="animate-slide-in rounded-2xl bg-gradient-to-r from-emerald-500 to-green-500 p-4 text-sm font-medium text-white shadow-lg" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="animate-slide-in rounded-2xl bg-gradient-to-r from-red-500 to-rose-500 p-4 text-sm font-medium text-white shadow-lg" role="alert">
                <p class="mb-2 font-semibold">Please fix the following:</p>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.1s">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/10 to-green-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Menu Items</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['menuItems'] }}</h3>
                    </div>
                    <div class="stat-card-icon rounded-2xl bg-gradient-to-br from-emerald-400 to-green-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h10" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.2s">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-cyan-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Restaurants</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['restaurants'] }}</h3>
                    </div>
                    <div class="stat-card-icon rounded-2xl bg-gradient-to-br from-blue-400 to-cyan-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7m-9 4h4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.3s">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Open Kitchens</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['openRestaurants'] }}</h3>
                    </div>
                    <div class="stat-card-icon rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zm0 0v13m-5-5h10" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="ios-card glass-card animate-fade-in rounded-3xl p-6" style="animation-delay: 0.4s">
                <h2 class="mb-6 text-xl font-bold text-neutral-900 dark:text-white">Add New Menu Item</h2>
                <form action="{{ route('menu-items.store') }}" method="POST" class="grid gap-5">
                    @csrf
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Restaurant</label>
                        <select name="restaurant_id" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                            <option value="">Unassigned</option>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" @selected(old('restaurant_id') == $restaurant->id)>
                                    {{ $restaurant->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('restaurant_id')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Item Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Beef Tapa" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('name')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Price (₱)</label>
                            <input type="number" step="0.01" min="0" name="price" value="{{ old('price') }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('price')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Description</label>
                        <textarea name="description" rows="3" placeholder="Short summary for riders & customers" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all resize-none placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="inline-flex items-center gap-3 text-sm font-medium text-neutral-700 dark:text-neutral-300">
                        <input type="checkbox" name="is_available" value="1" class="h-5 w-5 rounded-lg border-neutral-300 text-emerald-600 focus:ring-2 focus:ring-emerald-500/20" @checked(old('is_available', true))>
                        <span>Available for delivery</span>
                    </label>

                    <div>
                        <button type="submit" class="ios-button w-full rounded-2xl bg-gradient-to-r from-emerald-500 to-green-500 px-6 py-3.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                            Save Menu Item
                        </button>
                    </div>
                </form>
            </div>

            <div class="ios-card glass-card animate-fade-in rounded-3xl p-6" style="animation-delay: 0.5s">
                <h2 class="mb-6 text-xl font-bold text-neutral-900 dark:text-white">Quick Overview</h2>
                <ul class="space-y-4">
                    <li class="flex items-center justify-between rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Assigned to restaurants</span>
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-bold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">{{ $menuItems->whereNotNull('restaurant_id')->count() }}</span>
                    </li>
                    <li class="flex items-center justify-between rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Unassigned dishes</span>
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-sm font-bold text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">{{ $menuItems->whereNull('restaurant_id')->count() }}</span>
                    </li>
                    <li class="flex items-center justify-between rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Available for delivery</span>
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-bold text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">{{ $menuItems->where('is_available', true)->count() }}</span>
                    </li>
                    <li class="flex items-center justify-between rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                        <span class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Average price</span>
                        <span class="rounded-full bg-purple-100 px-3 py-1 text-sm font-bold text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                            ₱{{ number_format($menuItems->avg('price') ?? 0, 2) }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="ios-card glass-card relative h-full flex-1 overflow-hidden rounded-3xl animate-fade-in" style="animation-delay: 0.6s">
            <div class="flex h-full flex-col p-6">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Menu Items</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Primary records with relationships</p>
                    </div>
                    <a href="{{ route('restaurants.index') }}" class="ios-button rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                        Manage restaurants →
                    </a>
                </div>

                <div class="flex-1 overflow-auto rounded-2xl">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="border-b border-neutral-200/50 bg-white/30 backdrop-blur-sm dark:border-neutral-700/50 dark:bg-neutral-800/30">
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">#</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Dish</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Restaurant</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Price</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Status</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menuItems as $item)
                                <tr class="table-row border-b border-neutral-100/50 dark:border-neutral-800/50">
                                    <td class="px-5 py-4 text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4">
                                        <div class="text-sm font-semibold text-neutral-900 dark:text-white">{{ $item->name }}</div>
                                        <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">{{ $item->description ?: 'No description' }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ $item->restaurant->name ?? 'N/A' }}</td>
                                    <td class="px-5 py-4 text-sm font-bold text-neutral-900 dark:text-white">₱{{ number_format($item->price, 2) }}</td>
                                    <td class="px-5 py-4 text-sm">
                                        <span @class([
                                            'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                            'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' => $item->is_available,
                                            'bg-neutral-200 text-neutral-600 dark:bg-neutral-700 dark:text-neutral-400' => ! $item->is_available,
                                        ])>
                                            {{ $item->is_available ? 'Available' : 'Unavailable' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-sm">
                                        <div class="flex items-center gap-3">
                                            <button
                                                type="button"
                                                onclick="document.getElementById('edit-menu-{{ $item->id }}').showModal()"
                                                class="ios-button rounded-xl bg-blue-500/10 px-4 py-2 text-sm font-semibold text-blue-600 transition-all hover:bg-blue-500/20 dark:text-blue-400"
                                            >
                                                Edit
                                            </button>
                                            <form method="POST" action="{{ route('menu-items.destroy', $item) }}" onsubmit="return confirm('Delete this menu item?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ios-button rounded-xl bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-600 transition-all hover:bg-red-500/20 dark:text-red-400">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">No menu items found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($menuItems as $item)
        <dialog id="edit-menu-{{ $item->id }}" class="w-full max-w-2xl rounded-3xl border-0 bg-white/95 p-0 shadow-2xl backdrop-blur-xl dark:bg-neutral-900/95 animate-scale-in">
            <div class="flex items-center justify-between border-b border-neutral-200/50 px-8 py-5 dark:border-neutral-700/50">
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white">Edit Menu Item</h3>
                <button type="button" onclick="document.getElementById('edit-menu-{{ $item->id }}').close()" class="ios-button flex h-8 w-8 items-center justify-center rounded-full bg-neutral-100 text-neutral-500 transition-all hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-8">
                <form action="{{ route('menu-items.update', $item) }}" method="POST" class="grid gap-5">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Item Name</label>
                            <input type="text" name="name" value="{{ old('name', $item->name) }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Price (₱)</label>
                            <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $item->price) }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Restaurant</label>
                        <select name="restaurant_id" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                            <option value="">Unassigned</option>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" @selected(old('restaurant_id', $item->restaurant_id) == $restaurant->id)>
                                    {{ $restaurant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Description</label>
                        <textarea name="description" rows="3" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all resize-none focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Availability</label>
                        <select name="is_available" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                            <option value="1" @selected(old('is_available', $item->is_available) == true)>Available</option>
                            <option value="0" @selected(old('is_available', $item->is_available) == false)>Unavailable</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('edit-menu-{{ $item->id }}').close()" class="ios-button rounded-2xl border-0 bg-neutral-100 px-6 py-3 text-sm font-semibold text-neutral-700 shadow-sm transition-all hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">
                            Cancel
                        </button>
                        <button type="submit" class="ios-button rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:shadow-xl">
                            Update Item
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
    @endforeach
</x-layouts.app>