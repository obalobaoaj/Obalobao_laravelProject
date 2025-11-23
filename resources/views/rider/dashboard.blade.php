<x-layouts.app :title="__('Rider Dashboard')">
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

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .animate-slide-in {
            animation: slideIn 0.4s ease-out;
        }

        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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

        .ios-button {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .ios-button:active {
            transform: scale(0.97);
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

        @if (session('error'))
            <div class="animate-slide-in rounded-2xl bg-gradient-to-r from-red-500 to-rose-500 p-4 text-sm font-medium text-white shadow-lg" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.1s">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-cyan-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Available Orders</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['available'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-blue-400 to-cyan-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.2s">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/10 to-green-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Active Deliveries</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['active'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-emerald-400 to-green-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.3s">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Completed</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['completed'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.4s">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-400/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total Earnings</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">₱{{ number_format($stats['earnings'], 2) }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <!-- Available Orders -->
            <div class="ios-card glass-card rounded-3xl p-6">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Available Orders</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Ready for pickup</p>
                    </div>
                    @if($stats['available'] > 0)
                        <span class="animate-pulse-slow rounded-full bg-emerald-500 px-3 py-1 text-xs font-semibold text-white">New</span>
                    @endif
                </div>

                <div class="space-y-4 max-h-[600px] overflow-y-auto">
                    @forelse ($availableOrders as $order)
                        <div class="rounded-2xl bg-white/50 p-5 backdrop-blur-sm dark:bg-neutral-800/50">
                            <div class="mb-3 flex items-start justify-between">
                                <div>
                                    <h3 class="font-bold text-neutral-900 dark:text-white">{{ $order->order_number }}</h3>
                                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $order->restaurant->name }}</p>
                                </div>
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">Ready</span>
                            </div>
                            
                            <div class="mb-3 space-y-1 text-sm">
                                <p class="text-neutral-600 dark:text-neutral-400"><span class="font-semibold">To:</span> {{ $order->customer_name }}</p>
                                <p class="text-neutral-600 dark:text-neutral-400"><span class="font-semibold">Address:</span> {{ \Illuminate\Support\Str::limit($order->delivery_address, 40) }}</p>
                                <p class="font-bold text-neutral-900 dark:text-white">Total: ₱{{ number_format($order->total, 2) }}</p>
                            </div>

                            <form action="{{ route('rider.orders.accept', $order) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="ios-button w-full rounded-2xl bg-gradient-to-r from-emerald-500 to-green-500 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                                    Accept Order
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="rounded-2xl bg-white/50 p-8 text-center backdrop-blur-sm dark:bg-neutral-800/50">
                            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="mt-4 text-sm font-medium text-neutral-600 dark:text-neutral-400">No available orders</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- My Active Orders -->
            <div class="ios-card glass-card rounded-3xl p-6">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-neutral-900 dark:text-white">My Active Orders</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Currently delivering</p>
                    </div>
                </div>

                <div class="space-y-4 max-h-[600px] overflow-y-auto">
                    @forelse ($myOrders as $order)
                        <div class="rounded-2xl bg-white/50 p-5 backdrop-blur-sm dark:bg-neutral-800/50">
                            <div class="mb-3 flex items-start justify-between">
                                <div>
                                    <h3 class="font-bold text-neutral-900 dark:text-white">{{ $order->order_number }}</h3>
                                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $order->restaurant->name }}</p>
                                </div>
                                <span @class([
                                    'rounded-full px-3 py-1 text-xs font-semibold',
                                    'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' => $order->status === 'assigned',
                                    'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' => $order->status === 'picked_up',
                                    'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' => $order->status === 'in_transit',
                                ])>
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>
                            
                            <div class="mb-3 space-y-1 text-sm">
                                <p class="text-neutral-600 dark:text-neutral-400"><span class="font-semibold">To:</span> {{ $order->customer_name }}</p>
                                <p class="text-neutral-600 dark:text-neutral-400"><span class="font-semibold">Address:</span> {{ \Illuminate\Support\Str::limit($order->delivery_address, 40) }}</p>
                                <p class="font-bold text-neutral-900 dark:text-white">Total: ₱{{ number_format($order->total, 2) }}</p>
                            </div>

                            <div class="mt-4 flex gap-2">
                                @if($order->status === 'assigned')
                                    <form action="{{ route('rider.orders.update-status', $order) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="picked_up">
                                        <button type="submit" class="ios-button w-full rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                                            Mark Picked Up
                                        </button>
                                    </form>
                                @elseif($order->status === 'picked_up')
                                    <form action="{{ route('rider.orders.update-status', $order) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="in_transit">
                                        <button type="submit" class="ios-button w-full rounded-2xl bg-gradient-to-r from-purple-500 to-pink-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                                            Start Delivery
                                        </button>
                                    </form>
                                @elseif($order->status === 'in_transit')
                                    <form action="{{ route('rider.orders.update-status', $order) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="delivered">
                                        <button type="submit" class="ios-button w-full rounded-2xl bg-gradient-to-r from-emerald-500 to-green-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                                            Mark Delivered
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl bg-white/50 p-8 text-center backdrop-blur-sm dark:bg-neutral-800/50">
                            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="mt-4 text-sm font-medium text-neutral-600 dark:text-neutral-400">No active orders</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Completed Orders -->
        @if($completedOrders->count() > 0)
            <div class="ios-card glass-card rounded-3xl p-6">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Recent Deliveries</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Last 10 completed orders</p>
                    </div>
                    <a href="{{ route('rider.history') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400">
                        View All →
                    </a>
                </div>

                <div class="space-y-3">
                    @foreach ($completedOrders as $order)
                        <div class="flex items-center justify-between rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                            <div>
                                <p class="font-semibold text-neutral-900 dark:text-white">{{ $order->order_number }}</p>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $order->restaurant->name }} • {{ $order->delivered_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-neutral-900 dark:text-white">₱{{ number_format($order->total, 2) }}</p>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Fee: ₱{{ number_format($order->delivery_fee, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>

