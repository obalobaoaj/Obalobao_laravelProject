<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <style>
            .ios-sidebar {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border-right: 1px solid rgba(255, 255, 255, 0.3);
            }

            .dark .ios-sidebar {
                background: rgba(20, 20, 20, 0.8);
                border-right: 1px solid rgba(255, 255, 255, 0.1);
            }

            .ios-logo-container {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .ios-logo-container:hover {
                transform: translateX(2px);
            }

            .ios-nav-item {
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                border-radius: 12px;
                margin: 2px 0;
            }

            .ios-nav-item:hover {
                transform: translateX(4px);
            }

            .ios-nav-item[aria-current="page"] {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(147, 51, 234, 0.15));
                border: 1px solid rgba(59, 130, 246, 0.2);
            }

            .dark .ios-nav-item[aria-current="page"] {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(147, 51, 234, 0.2));
                border: 1px solid rgba(59, 130, 246, 0.3);
            }

            .ios-section-heading {
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                color: rgb(115, 115, 115);
            }

            .dark .ios-section-heading {
                color: rgb(163, 163, 163);
            }

            .ios-user-profile {
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                border-radius: 12px;
                padding: 8px;
            }

            .ios-user-profile:hover {
                background: rgba(0, 0, 0, 0.05);
                transform: scale(1.02);
            }

            .dark .ios-user-profile:hover {
                background: rgba(255, 255, 255, 0.05);
            }

            .ios-user-avatar {
                background: linear-gradient(135deg, #3b82f6, #9333ea);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .ios-nav-group {
                margin-bottom: 24px;
            }
        </style>

        <flux:sidebar sticky stashable class="ios-sidebar border-e-0">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ auth()->user()->isRider() ? route('rider.dashboard') : route('dashboard') }}" class="ios-logo-container me-5 mb-8 flex items-center space-x-3 rtl:space-x-reverse px-2 py-3" wire:navigate>
                <div class="flex aspect-square size-10 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-lg">
                    <x-app-logo-icon class="size-6 fill-current text-white" />
                </div>
                <div class="grid flex-1 text-start">
                    <span class="truncate text-base font-bold leading-tight text-neutral-900 dark:text-white">Laravel Starter Kit</span>
                    <span class="truncate text-xs font-medium leading-tight text-neutral-500 dark:text-neutral-400">Restaurant & Delivery</span>
                </div>
            </a>

            <div class="ios-nav-group">
                <flux:navlist variant="outline" class="space-y-1">
                    <div class="mb-3 px-3">
                        <p class="ios-section-heading">{{ __('Platform') }}</p>
                    </div>
                    @auth
                        @if(auth()->user()->isRider())
                            <flux:navlist.item
                                icon="truck"
                                :href="route('rider.dashboard')"
                                :current="request()->routeIs('rider.*')"
                                wire:navigate
                                class="ios-nav-item mx-2"
                            >
                                {{ __('Rider Dashboard') }}
                            </flux:navlist.item>
                            <flux:navlist.item
                                icon="clock"
                                :href="route('rider.history')"
                                :current="request()->routeIs('rider.history')"
                                wire:navigate
                                class="ios-nav-item mx-2"
                            >
                                {{ __('Delivery History') }}
                            </flux:navlist.item>
                        @else
                            <flux:navlist.item
                                icon="layout-grid"
                                :href="route('dashboard')"
                                :current="request()->routeIs('dashboard')"
                                wire:navigate
                                class="ios-nav-item mx-2"
                            >
                                {{ __('Menu Dashboard') }}
                            </flux:navlist.item>
                            <flux:navlist.item
                                icon="folder-git-2"
                                :href="route('restaurants.index')"
                                :current="request()->routeIs('restaurants.*')"
                                wire:navigate
                                class="ios-nav-item mx-2"
                            >
                                {{ __('Restaurants') }}
                            </flux:navlist.item>
                            <flux:navlist.item
                                icon="shopping-cart"
                                :href="route('orders.index')"
                                :current="request()->routeIs('orders.*')"
                                wire:navigate
                                class="ios-nav-item mx-2"
                            >
                                {{ __('Orders') }}
                            </flux:navlist.item>
                        @endif
                    @endauth
                </flux:navlist>
            </div>

            <flux:spacer />

            <div class="ios-nav-group">
                <flux:navlist variant="outline" class="space-y-1">
                    <div class="mb-3 px-3">
                        <p class="ios-section-heading">{{ __('Resources') }}</p>
                    </div>
                    <flux:navlist.item 
                        icon="folder-git-2" 
                        href="https://github.com/laravel/livewire-starter-kit" 
                        target="_blank"
                        class="ios-nav-item mx-2"
                    >
                        {{ __('Repository') }}
                    </flux:navlist.item>

                    <flux:navlist.item 
                        icon="book-open-text" 
                        href="https://laravel.com/docs/starter-kits#livewire" 
                        target="_blank"
                        class="ios-nav-item mx-2"
                    >
                        {{ __('Documentation') }}
                    </flux:navlist.item>
                </flux:navlist>
            </div>

            <!-- Desktop User Menu -->
            <div class="mt-auto px-2 pb-4">
                <flux:dropdown class="hidden lg:block w-full" position="top" align="start">
                    <button class="ios-user-profile w-full flex items-center gap-3 rounded-2xl p-3 text-left transition-all">
                        <span class="ios-user-avatar relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-sm font-bold text-white shadow-md">
                            {{ auth()->user()->initials() }}
                        </span>
                        <div class="grid flex-1 min-w-0 text-start text-sm leading-tight">
                            <span class="truncate font-bold text-neutral-900 dark:text-white">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ auth()->user()->email }}</span>
                        </div>
                        <svg class="h-5 w-5 flex-shrink-0 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <flux:menu class="w-[240px] rounded-2xl border-0 bg-white/95 shadow-2xl backdrop-blur-xl dark:bg-neutral-900/95">
                        <flux:menu.radio.group>
                            <div class="p-2">
                                <div class="flex items-center gap-3 rounded-xl bg-gradient-to-br from-blue-50 to-purple-50 p-3 dark:from-blue-900/20 dark:to-purple-900/20">
                                    <span class="ios-user-avatar relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-sm font-bold text-white shadow-md">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                    <div class="grid flex-1 min-w-0 text-start text-sm leading-tight">
                                        <span class="truncate font-bold text-neutral-900 dark:text-white">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator class="my-2" />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="mx-2 rounded-xl transition-all hover:bg-neutral-100 dark:hover:bg-neutral-800">
                                {{ __('Settings') }}
                            </flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator class="my-2" />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="mx-2 rounded-xl text-red-600 transition-all hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </div>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden ios-sidebar border-b-0">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <button class="ios-user-profile flex items-center gap-2 rounded-2xl p-2 transition-all">
                    <span class="ios-user-avatar relative flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-sm font-bold text-white shadow-md">
                        {{ auth()->user()->initials() }}
                    </span>
                    <svg class="h-4 w-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <flux:menu class="w-[240px] rounded-2xl border-0 bg-white/95 shadow-2xl backdrop-blur-xl dark:bg-neutral-900/95">
                    <flux:menu.radio.group>
                        <div class="p-2">
                            <div class="flex items-center gap-3 rounded-xl bg-gradient-to-br from-blue-50 to-purple-50 p-3 dark:from-blue-900/20 dark:to-purple-900/20">
                                <span class="ios-user-avatar relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-sm font-bold text-white shadow-md">
                                    {{ auth()->user()->initials() }}
                                </span>
                                <div class="grid flex-1 min-w-0 text-start text-sm leading-tight">
                                    <span class="truncate font-bold text-neutral-900 dark:text-white">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="my-2" />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="mx-2 rounded-xl transition-all hover:bg-neutral-100 dark:hover:bg-neutral-800">
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="my-2" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="mx-2 rounded-xl text-red-600 transition-all hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
