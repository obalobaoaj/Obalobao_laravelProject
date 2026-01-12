<x-layouts.app :title="__('Restaurants Management')">
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
            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in stat-card" style="animation-delay: 0.1s">
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

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in stat-card" style="animation-delay: 0.2s">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/10 to-green-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Open Kitchens</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['open'] }}</h3>
                    </div>
                    <div class="stat-card-icon rounded-2xl bg-gradient-to-br from-emerald-400 to-green-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zm0 0v13m-5-5h10" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in stat-card" style="animation-delay: 0.3s">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Avg Prep Time</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ round($stats['averagePrep'] ?? 0) }} mins</h3>
                    </div>
                    <div class="stat-card-icon rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="ios-card glass-card animate-fade-in rounded-3xl p-6" style="animation-delay: 0.4s">
                <h2 class="mb-6 text-xl font-bold text-neutral-900 dark:text-white">Add Restaurant</h2>
                <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-5">
                    @csrf
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Sunset Diner" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('name')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Cuisine</label>
                            <input type="text" name="cuisine_type" value="{{ old('cuisine_type') }}" required placeholder="Filipino" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('cuisine_type')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="hello@restaurant.com" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('email')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+63 900 000 0000" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('phone')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" required placeholder="123 Food Street, City" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                        @error('address')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Photo (JPG/PNG, max 2MB)</label>
                        <input type="file" name="photo" accept=".jpg,.jpeg,.png" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                        @error('photo')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Delivery Fee (₱)</label>
                            <input type="number" step="0.01" min="0" name="delivery_fee" value="{{ old('delivery_fee', 0) }}" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('delivery_fee')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Prep Time (mins)</label>
                            <input type="number" min="5" name="avg_prep_time" value="{{ old('avg_prep_time', 20) }}" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                            @error('avg_prep_time')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Status</label>
                            <select name="status" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                                <option value="open" @selected(old('status', 'open') === 'open')>Open</option>
                                <option value="paused" @selected(old('status') === 'paused')>Paused</option>
                                <option value="closed" @selected(old('status') === 'closed')>Closed</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="ios-button w-full rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-3.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                            Save Restaurant
                        </button>
                    </div>
                </form>
            </div>

            <div class="ios-card glass-card animate-fade-in rounded-3xl p-6" style="animation-delay: 0.5s">
                <div class="mb-4 flex items-center gap-3">
                    <div class="rounded-2xl bg-gradient-to-br from-blue-400 to-cyan-500 p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Why capture restaurants?</h2>
                </div>
                <p class="text-sm leading-relaxed text-neutral-600 dark:text-neutral-300">
                    Keep each kitchen's delivery fee, average prep time, and operating status up to date so riders and dispatch know what's live. Menu items automatically reference these records, and deleting a restaurant preserves menu history by setting their relationship to <em class="font-semibold text-neutral-900 dark:text-white">null</em>.
                </p>
                <div class="mt-6 space-y-3">
                    <div class="flex items-start gap-3 rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                        <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm text-neutral-700 dark:text-neutral-300">Track delivery fees and prep times</p>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                        <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm text-neutral-700 dark:text-neutral-300">Monitor operating status in real-time</p>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                        <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm text-neutral-700 dark:text-neutral-300">Preserve menu history when deleted</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="ios-card glass-card relative h-full flex-1 overflow-hidden rounded-3xl animate-fade-in" style="animation-delay: 0.6s">
            <div class="flex h-full flex-col p-6">
                <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Restaurants Directory</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Search, filter, export, and manage trash.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('restaurants.trash') }}" class="ios-button rounded-2xl bg-neutral-900 px-5 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                            Trash ({{ $filters['trashCount'] ?? 0 }})
                        </a>
                        <a href="{{ route('restaurants.export', ['q' => request('q'), 'status' => request('status'), 'cuisine' => request('cuisine')]) }}" class="ios-button rounded-2xl bg-gradient-to-r from-emerald-500 to-green-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                            Export PDF
                        </a>
                        <a href="{{ route('dashboard') }}" class="ios-button rounded-2xl bg-gradient-to-r from-purple-500 to-pink-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                            ← Back to dashboard
                        </a>
                    </div>
                </div>

                <form method="GET" class="mb-4 grid gap-3 md:grid-cols-4 items-center">
                    <div class="md:col-span-2">
                        <input type="text" name="q" value="{{ $search }}" placeholder="Search name, email, or address" class="w-full rounded-2xl border border-neutral-200 bg-white/80 px-4 py-3 text-sm shadow-sm focus:border-blue-400 focus:outline-none dark:border-neutral-700 dark:bg-neutral-800/80 dark:text-white">
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
                        <a href="{{ route('restaurants.index') }}" class="ios-button rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-neutral-700 shadow hover:bg-neutral-50 dark:bg-neutral-800 dark:text-neutral-100">
                            Clear
                        </a>
                    </div>
                </form>

                <div class="flex-1 overflow-auto rounded-2xl">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="border-b border-neutral-200/50 bg-white/30 backdrop-blur-sm dark:border-neutral-700/50 dark:bg-neutral-800/30">
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Profile</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Name</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Cuisine</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Status</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Menu Items</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($restaurants as $restaurant)
                                <tr class="table-row border-b border-neutral-100/50 dark:border-neutral-800/50">
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
                                    <td class="px-5 py-4 text-sm">
                                        <span @class([
                                            'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                            'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' => $restaurant->status === 'open',
                                            'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' => $restaurant->status === 'paused',
                                            'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' => $restaurant->status === 'closed',
                                        ])>
                                            {{ ucfirst($restaurant->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-sm font-bold text-neutral-900 dark:text-white">{{ $restaurant->menu_items_count }}</td>
                                    <td class="px-5 py-4 text-sm">
                                        <div class="flex items-center gap-3">
                                            <button
                                                type="button"
                                                onclick="document.getElementById('edit-restaurant-{{ $restaurant->id }}').showModal()"
                                                class="ios-button rounded-xl bg-blue-500/10 px-4 py-2 text-sm font-semibold text-blue-600 transition-all hover:bg-blue-500/20 dark:text-blue-400"
                                            >
                                                Edit
                                            </button>
                                            <form method="POST" action="{{ route('restaurants.destroy', $restaurant) }}" onsubmit="return confirm('Delete this restaurant?');" class="inline">
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
                                    <td colspan="5" class="px-5 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7m-9 4h4" />
                                            </svg>
                                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">No restaurants found.</p>
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

    @foreach ($restaurants as $restaurant)
        <dialog id="edit-restaurant-{{ $restaurant->id }}" class="w-full max-w-3xl rounded-3xl border-0 bg-white/95 p-0 shadow-2xl backdrop-blur-xl dark:bg-neutral-900/95 animate-scale-in">
            <div class="flex items-center justify-between border-b border-neutral-200/50 px-8 py-5 dark:border-neutral-700/50">
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white">Edit Restaurant</h3>
                <button type="button" onclick="document.getElementById('edit-restaurant-{{ $restaurant->id }}').close()" class="ios-button flex h-8 w-8 items-center justify-center rounded-full bg-neutral-100 text-neutral-500 transition-all hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:bg-neutral-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-8">
                <form action="{{ route('restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data" class="grid gap-5">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</label>
                            <input type="text" name="name" value="{{ old('name', $restaurant->name) }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Cuisine</label>
                            <input type="text" name="cuisine_type" value="{{ old('cuisine_type', $restaurant->cuisine_type) }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Email</label>
                            <input type="email" name="email" value="{{ old('email', $restaurant->email) }}" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone', $restaurant->phone) }}" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Address</label>
                        <input type="text" name="address" value="{{ old('address', $restaurant->address) }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Photo (JPG/PNG, max 2MB)</label>
                        <div class="mb-3 flex items-center gap-4">
                            @if($restaurant->photo_url)
                                <img src="{{ $restaurant->photo_url }}" alt="{{ $restaurant->name }}" class="h-16 w-16 rounded-full object-cover shadow-md ring-2 ring-white dark:ring-neutral-800">
                                <div>
                                    <p class="text-xs font-medium text-neutral-600 dark:text-neutral-400">Current photo</p>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-500">{{ basename($restaurant->photo_path) }}</p>
                                </div>
                            @else
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-purple-600 text-lg font-bold text-white shadow-md ring-2 ring-white dark:ring-neutral-800">
                                    {{ strtoupper(mb_substr($restaurant->name, 0, 1)) }}
                                </div>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">No photo uploaded</p>
                            @endif
                        </div>
                        <input type="file" name="photo" accept=".jpg,.jpeg,.png" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800">
                        @error('photo')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Delivery Fee (₱)</label>
                            <input type="number" step="0.01" min="0" name="delivery_fee" value="{{ old('delivery_fee', $restaurant->delivery_fee) }}" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Prep Time (mins)</label>
                            <input type="number" min="5" name="avg_prep_time" value="{{ old('avg_prep_time', $restaurant->avg_prep_time) }}" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Status</label>
                            <select name="status" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                                <option value="open" @selected(old('status', $restaurant->status) === 'open')>Open</option>
                                <option value="paused" @selected(old('status', $restaurant->status) === 'paused')>Paused</option>
                                <option value="closed" @selected(old('status', $restaurant->status) === 'closed')>Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('edit-restaurant-{{ $restaurant->id }}').close()" class="ios-button rounded-2xl border-0 bg-neutral-100 px-6 py-3 text-sm font-semibold text-neutral-700 shadow-sm transition-all hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">
                            Cancel
                        </button>
                        <button type="submit" class="ios-button rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:shadow-xl">
                            Update Restaurant
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
    @endforeach
</x-layouts.app>

