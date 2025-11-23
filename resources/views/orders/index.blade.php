<x-layouts.app :title="__('Orders Management')">
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

        .animate-slide-in {
            animation: slideIn 0.4s ease-out;
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

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .dark .table-row:hover {
            background: rgba(255, 255, 255, 0.05);
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

        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-5">
            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.1s">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-cyan-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total Orders</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-blue-400 to-cyan-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.2s">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-400/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Pending</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['pending'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.3s">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/10 to-green-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Ready</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['ready'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-emerald-400 to-green-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.4s">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">In Transit</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['in_transit'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="ios-card glass-card group relative overflow-hidden rounded-3xl p-6 animate-slide-in" style="animation-delay: 0.5s">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Delivered</p>
                        <h3 class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">{{ $stats['delivered'] }}</h3>
                    </div>
                    <div class="rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-500 p-4 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="ios-card glass-card relative h-full flex-1 overflow-hidden rounded-3xl">
            <div class="flex h-full flex-col p-6">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-neutral-900 dark:text-white">All Orders</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Manage and track all orders</p>
                    </div>
                    <a href="{{ route('orders.create') }}" class="ios-button rounded-2xl bg-gradient-to-r from-blue-500 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg hover:shadow-xl">
                        + New Order
                    </a>
                </div>

                <div class="flex-1 overflow-auto rounded-2xl">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="border-b border-neutral-200/50 bg-white/30 backdrop-blur-sm dark:border-neutral-700/50 dark:bg-neutral-800/30">
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Order #</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Restaurant</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Customer</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Rider</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Total</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Status</th>
                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="table-row border-b border-neutral-100/50 dark:border-neutral-800/50">
                                    <td class="px-5 py-4 text-sm font-semibold text-neutral-900 dark:text-white">{{ $order->order_number }}</td>
                                    <td class="px-5 py-4 text-sm font-medium text-neutral-600 dark:text-neutral-300">{{ $order->restaurant->name }}</td>
                                    <td class="px-5 py-4">
                                        <div class="text-sm font-medium text-neutral-900 dark:text-white">{{ $order->customer_name }}</div>
                                        <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $order->customer_phone }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                                        {{ $order->rider->name ?? 'Unassigned' }}
                                    </td>
                                    <td class="px-5 py-4 text-sm font-bold text-neutral-900 dark:text-white">₱{{ number_format($order->total, 2) }}</td>
                                    <td class="px-5 py-4 text-sm">
                                        <span @class([
                                            'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                            'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' => in_array($order->status, ['pending', 'confirmed', 'preparing']),
                                            'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' => $order->status === 'ready',
                                            'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' => in_array($order->status, ['assigned', 'picked_up']),
                                            'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' => $order->status === 'in_transit',
                                            'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' => $order->status === 'delivered',
                                            'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' => $order->status === 'cancelled',
                                        ])>
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-sm">
                                        <div class="flex items-center gap-2">
                                            @if(in_array($order->status, ['confirmed', 'preparing', 'ready']))
                                                <form action="{{ route('orders.update-status', $order) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($order->status === 'confirmed')
                                                        <input type="hidden" name="status" value="preparing">
                                                        <button type="submit" class="ios-button rounded-xl bg-blue-500/10 px-3 py-1.5 text-xs font-semibold text-blue-600 transition-all hover:bg-blue-500/20 dark:text-blue-400">
                                                            Preparing
                                                        </button>
                                                    @elseif($order->status === 'preparing')
                                                        <input type="hidden" name="status" value="ready">
                                                        <button type="submit" class="ios-button rounded-xl bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-600 transition-all hover:bg-emerald-500/20 dark:text-emerald-400">
                                                            Ready
                                                        </button>
                                                    @endif
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">No orders found.</p>
                                            <a href="{{ route('orders.create') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400">
                                                Create your first order →
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($orders->hasPages())
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>


