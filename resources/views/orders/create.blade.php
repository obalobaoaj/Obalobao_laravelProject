<x-layouts.app :title="__('Create New Order')">
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

        .ios-input {
            transition: all 0.2s ease;
        }

        .ios-input:focus {
            transform: scale(1.01);
        }

        .ios-button {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .ios-button:active {
            transform: scale(0.97);
        }
    </style>

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-2xl p-2">
        <div class="ios-card glass-card rounded-3xl p-6">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Create New Order</h2>
                    <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Add a new delivery order</p>
                </div>
                <a href="{{ route('orders.index') }}" class="text-sm font-semibold text-neutral-600 hover:text-neutral-900 dark:text-neutral-400 dark:hover:text-white">
                    ← Back to Orders
                </a>
            </div>

            <form action="{{ route('orders.store') }}" method="POST" class="grid gap-6">
                @csrf

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Restaurant *</label>
                        <select name="restaurant_id" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800">
                            <option value="">Select Restaurant</option>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" @selected(old('restaurant_id') == $restaurant->id)>
                                    {{ $restaurant->name }} - {{ $restaurant->cuisine_type }}
                                </option>
                            @endforeach
                        </select>
                        @error('restaurant_id')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Customer Name *</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800" placeholder="John Doe">
                        @error('customer_name')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Customer Phone *</label>
                        <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800" placeholder="+63 900 000 0000">
                        @error('customer_phone')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Delivery Address *</label>
                        <input type="text" name="delivery_address" value="{{ old('delivery_address') }}" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800" placeholder="123 Street, City">
                        @error('delivery_address')
                            <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Order Items *</label>
                    <div id="items-container" class="space-y-4">
                        <div class="item-row rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50">
                            <div class="grid gap-4 md:grid-cols-3">
                                <div class="md:col-span-2">
                                    <select name="items[0][menu_item_id]" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800 menu-item-select">
                                        <option value="">Select Menu Item</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="number" name="items[0][quantity]" value="1" min="1" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800" placeholder="Qty">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-item" class="mt-4 rounded-2xl bg-neutral-100 px-4 py-2 text-sm font-semibold text-neutral-700 hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">
                        + Add Item
                    </button>
                    @error('items')
                        <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-neutral-700 dark:text-neutral-300">Notes (Optional)</label>
                    <textarea name="notes" rows="3" class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all resize-none placeholder:text-neutral-400 focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:placeholder:text-neutral-500 dark:focus:bg-neutral-800" placeholder="Special delivery instructions...">{{ old('notes') }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('orders.index') }}" class="ios-button rounded-2xl border-0 bg-neutral-100 px-6 py-3 text-sm font-semibold text-neutral-700 shadow-sm transition-all hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">
                        Cancel
                    </a>
                    <button type="submit" class="ios-button rounded-2xl bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:shadow-xl">
                        Create Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let itemCount = 1;
        const restaurants = @json($restaurants->keyBy('id'));
        const menuItemsByRestaurant = @json($restaurants->mapWithKeys(function($restaurant) {
            return [$restaurant->id => $restaurant->menuItems->map(function($item) {
                return ['id' => $item->id, 'name' => $item->name, 'price' => $item->price];
            })];
        }));

        document.getElementById('add-item').addEventListener('click', function() {
            const container = document.getElementById('items-container');
            const newRow = document.createElement('div');
            newRow.className = 'item-row rounded-2xl bg-white/50 p-4 backdrop-blur-sm dark:bg-neutral-800/50';
            newRow.innerHTML = `
                <div class="grid gap-4 md:grid-cols-3">
                    <div class="md:col-span-2">
                        <select name="items[${itemCount}][menu_item_id]" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800 menu-item-select">
                            <option value="">Select Menu Item</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <input type="number" name="items[${itemCount}][quantity]" value="1" min="1" required class="ios-input w-full rounded-2xl border-0 bg-white/80 px-4 py-3.5 text-sm shadow-sm backdrop-blur-sm transition-all focus:bg-white focus:shadow-md dark:bg-neutral-800/80 dark:text-neutral-100 dark:focus:bg-neutral-800" placeholder="Qty">
                        <button type="button" class="remove-item rounded-2xl bg-red-100 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-200 dark:bg-red-900/20 dark:text-red-400">
                            Remove
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            
            const select = newRow.querySelector('.menu-item-select');
            updateMenuItems(select);
            
            newRow.querySelector('.remove-item').addEventListener('click', function() {
                newRow.remove();
            });
            
            itemCount++;
        });

        function updateMenuItems(selectElement) {
            const restaurantSelect = document.querySelector('select[name="restaurant_id"]');
            const restaurantId = restaurantSelect.value;
            
            selectElement.innerHTML = '<option value="">Select Menu Item</option>';
            
            if (restaurantId && menuItemsByRestaurant[restaurantId]) {
                menuItemsByRestaurant[restaurantId].forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = `${item.name} - ₱${parseFloat(item.price).toFixed(2)}`;
                    selectElement.appendChild(option);
                });
            }
        }

        document.querySelector('select[name="restaurant_id"]').addEventListener('change', function() {
            document.querySelectorAll('.menu-item-select').forEach(select => {
                updateMenuItems(select);
            });
        });

        // Initialize first select
        document.querySelectorAll('.menu-item-select').forEach(select => {
            updateMenuItems(select);
        });
    </script>
</x-layouts.app>


