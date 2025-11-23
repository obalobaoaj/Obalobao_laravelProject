<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Obalobao') }} - Restaurant & Delivery Management</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gradient-to-br from-neutral-50 via-white to-blue-50 dark:from-neutral-950 dark:via-neutral-900 dark:to-neutral-950 overflow-x-hidden">
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
            }

            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
                50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6); }
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-slide-up {
                animation: slideInUp 0.8s ease-out forwards;
            }

            .animate-slide-left {
                animation: slideInLeft 0.8s ease-out forwards;
            }

            .animate-slide-right {
                animation: slideInRight 0.8s ease-out forwards;
            }

            .animate-scale-in {
                animation: scaleIn 0.6s ease-out forwards;
            }

            .gradient-animated {
                background-size: 200% 200%;
                animation: gradient 8s ease infinite;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            }

            .dark .glass-card {
                background: rgba(30, 30, 30, 0.7);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            }

            .hover-lift {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .hover-lift:hover {
                transform: translateY(-8px);
            }

            .parallax-slow {
                transition: transform 0.3s ease-out;
            }

            .feature-card {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .feature-card:hover {
                transform: translateY(-12px) scale(1.02);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .dark .feature-card:hover {
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            }

            .magnetic {
                transition: transform 0.2s ease-out;
            }

            .text-gradient {
                background: linear-gradient(135deg, #3b82f6, #8b5cf6, #ec4899);
                background-size: 200% 200%;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: gradient 5s ease infinite;
            }

            .delay-100 { animation-delay: 0.1s; opacity: 0; }
            .delay-200 { animation-delay: 0.2s; opacity: 0; }
            .delay-300 { animation-delay: 0.3s; opacity: 0; }
            .delay-400 { animation-delay: 0.4s; opacity: 0; }
            .delay-500 { animation-delay: 0.5s; opacity: 0; }
            .delay-600 { animation-delay: 0.6s; opacity: 0; }

            .scroll-reveal {
                opacity: 0;
                transform: translateY(50px);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .scroll-reveal.revealed {
                opacity: 1;
                transform: translateY(0);
            }
        </style>

        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass-card border-b border-neutral-200/50 dark:border-neutral-700/50">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 animate-slide-left">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-lg hover:shadow-xl transition-shadow">
                            <x-app-logo-icon class="h-6 w-6 fill-current text-white" />
                        </div>
                        <span class="text-xl font-bold text-neutral-900 dark:text-white">Obalobao</span>
                    </div>
                    <div class="flex items-center gap-4 animate-slide-right">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold hover:shadow-lg transition-all hover:scale-105">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 text-neutral-700 dark:text-neutral-300 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold hover:shadow-lg transition-all hover:scale-105">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl animate-float"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-400/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-pink-400/10 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="max-w-5xl mx-auto text-center">
                    <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold mb-6 animate-slide-up delay-100">
                        <span class="text-gradient">Restaurant</span>
                        <br>
                        <span class="text-neutral-900 dark:text-white">Management</span>
                        <br>
                        <span class="text-gradient">Made Simple</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-neutral-600 dark:text-neutral-400 mb-8 max-w-2xl mx-auto animate-slide-up delay-200">
                        Streamline your restaurant operations with our powerful delivery management platform. 
                        Manage menus, track orders, and delight customers.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up delay-300">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold text-lg hover:shadow-2xl transition-all hover:scale-105 pulse-glow">
                                Go to Dashboard →
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold text-lg hover:shadow-2xl transition-all hover:scale-105 pulse-glow">
                                Get Started Free →
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-4 rounded-2xl glass-card border-2 border-neutral-200 dark:border-neutral-700 text-neutral-900 dark:text-white font-bold text-lg hover:shadow-xl transition-all hover:scale-105">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Floating Cards -->
                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    <div class="glass-card rounded-3xl p-6 hover-lift animate-scale-in delay-400">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h10" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Menu Management</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Easily create and organize your restaurant menu items</p>
                    </div>
                    <div class="glass-card rounded-3xl p-6 hover-lift animate-scale-in delay-500">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7m-9 4h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Restaurant Control</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Manage multiple restaurants from one dashboard</p>
                    </div>
                    <div class="glass-card rounded-3xl p-6 hover-lift animate-scale-in delay-600">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zm0 0v13m-5-5h10" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Real-time Updates</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Track orders and status in real-time</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 relative">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16 scroll-reveal">
                    <h2 class="text-4xl md:text-5xl font-bold text-neutral-900 dark:text-white mb-4">
                        Powerful Features for <span class="text-gradient">Modern Restaurants</span>
                    </h2>
                    <p class="text-xl text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto">
                        Everything you need to manage your restaurant operations efficiently
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="feature-card glass-card rounded-3xl p-8 scroll-reveal">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Easy Menu Setup</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Create and manage your menu items with ease. Add descriptions, prices, and availability status in seconds.</p>
                    </div>

                    <div class="feature-card glass-card rounded-3xl p-8 scroll-reveal">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Multi-Restaurant Support</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Manage multiple restaurants from a single dashboard. Track each location independently.</p>
                    </div>

                    <div class="feature-card glass-card rounded-3xl p-8 scroll-reveal">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Prep Time Tracking</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Set and monitor average preparation times for better delivery scheduling.</p>
                    </div>

                    <div class="feature-card glass-card rounded-3xl p-8 scroll-reveal">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Status Management</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Control restaurant status - open, paused, or closed - with a single click.</p>
                    </div>

                    <div class="feature-card glass-card rounded-3xl p-8 scroll-reveal">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-rose-400 to-red-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Delivery Fee Control</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Set custom delivery fees for each restaurant location.</p>
                    </div>

                    <div class="feature-card glass-card rounded-3xl p-8 scroll-reveal">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Lightning Fast</h3>
                        <p class="text-neutral-600 dark:text-neutral-400">Built with modern technology for speed and reliability.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 relative">
            <div class="container mx-auto px-6">
                <div class="glass-card rounded-3xl p-12 md:p-16 text-center max-w-4xl mx-auto scroll-reveal">
                    <h2 class="text-4xl md:text-5xl font-bold text-neutral-900 dark:text-white mb-6">
                        Ready to Transform Your Restaurant?
                    </h2>
                    <p class="text-xl text-neutral-600 dark:text-neutral-400 mb-8 max-w-2xl mx-auto">
                        Join thousands of restaurants already using Obalobao to streamline their operations.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold text-lg hover:shadow-2xl transition-all hover:scale-105">
                                Go to Dashboard →
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold text-lg hover:shadow-2xl transition-all hover:scale-105">
                                Start Free Trial →
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-4 rounded-2xl border-2 border-neutral-200 dark:border-neutral-700 text-neutral-900 dark:text-white font-bold text-lg hover:shadow-xl transition-all hover:scale-105">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 border-t border-neutral-200 dark:border-neutral-800">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center gap-3 mb-4 md:mb-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600">
                            <x-app-logo-icon class="h-6 w-6 fill-current text-white" />
                        </div>
                        <span class="text-lg font-bold text-neutral-900 dark:text-white">Obalobao</span>
                    </div>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm">
                        © {{ date('Y') }} Obalobao. All rights reserved.
                    </p>
                </div>
        </div>
        </footer>

        <script>
            // Scroll reveal animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });

            // Parallax effect on scroll
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.parallax-slow');
                parallaxElements.forEach(element => {
                    const speed = 0.5;
                    element.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Magnetic effect on buttons
            document.querySelectorAll('a[href]').forEach(link => {
                link.addEventListener('mousemove', (e) => {
                    const rect = link.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    link.style.transform = `translate(${(x - rect.width / 2) * 0.1}px, ${(y - rect.height / 2) * 0.1}px)`;
                });
                
                link.addEventListener('mouseleave', () => {
                    link.style.transform = 'translate(0, 0)';
                });
            });
        </script>
    </body>
</html>
