<x-layouts.app :title="__('Delivery History')">
    <style>
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
        }
    </style>

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-2xl p-2">
        <div class="ios-card glass-card rounded-3xl p-6">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Delivery History</h2>
                    <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">All completed deliveries</p>
                </div>
                <div class="rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 px-6 py-3">
                    <p class="text-sm font-medium text-white">Total Earnings</p>
                    <p class="text-2xl font-bold text-white">₱{{ number_format($totalEarnings, 2) }}</p>
                </div>
            </div>

            <div class="space-y-4">
                @forelse ($orders as $order)
                    <div class="rounded-2xl bg-white/50 p-5 backdrop-blur-sm dark:bg-neutral-800/50">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="mb-2 flex items-center gap-3">
                                    <h3 class="font-bold text-neutral-900 dark:text-white">{{ $order->order_number }}</h3>
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">Delivered</span>
                                </div>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $order->restaurant->name }}</p>
                                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">To: {{ $order->customer_name }}</p>
                                <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">{{ $order->delivered_at->format('M d, Y h:i A') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-neutral-900 dark:text-white">₱{{ number_format($order->total, 2) }}</p>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">Fee: ₱{{ number_format($order->delivery_fee, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl bg-white/50 p-12 text-center backdrop-blur-sm dark:bg-neutral-800/50">
                        <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-4 text-sm font-medium text-neutral-600 dark:text-neutral-400">No delivery history yet</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>


