<nav x-data="{ open: false, adminOpen: false }" class="nav-glow fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold gradient-text hover-lift transition-all">
                    <i class="fas fa-store mr-2"></i>
                    E-Commerce Store
                </a>
                
                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex space-x-8 ml-10">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-accent transition-colors duration-300">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-accent transition-colors duration-300">
                        <i class="fas fa-box-open mr-1"></i> Products
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-300 hover:text-accent transition-colors duration-300">
                        <i class="fas fa-info-circle mr-1"></i> About
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-300 hover:text-accent transition-colors duration-300">
                        <i class="fas fa-envelope mr-1"></i> Contact
                    </a>
                    <a href="{{ route('help') }}" class="text-gray-300 hover:text-accent transition-colors duration-300">
                        <i class="fas fa-question-circle mr-1"></i> Help
                    </a>
                    
                    @auth
                        <a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-accent transition-colors duration-300">
                            <i class="fas fa-truck mr-1"></i> My Orders
                        </a>
                        
                        @if(auth()->user()->isAdmin())
                            <div class="relative">
                                <button @click="adminOpen = !adminOpen" class="text-gray-300 hover:text-accent transition-colors duration-300 inline-flex items-center gap-1">
                                    <i class="fas fa-chart-line mr-1"></i> Admin Panel
                                    <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': adminOpen}"></i>
                                </button>
                                
                                <div x-show="adminOpen" @click.away="adminOpen = false" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="absolute left-0 mt-2 w-56 glass-card rounded-lg shadow-xl py-2 z-50"
                                     style="display: none;">
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-primary-light/20 transition-colors">
                                        <i class="fas fa-tachometer-alt mr-2 w-5"></i> Dashboard
                                    </a>
                                    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm hover:bg-primary-light/20 transition-colors">
                                        <i class="fas fa-boxes mr-2 w-5"></i> Manage Products
                                    </a>
                                    <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-sm hover:bg-primary-light/20 transition-colors">
                                        <i class="fas fa-shopping-cart mr-2 w-5"></i> Manage Orders
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Notification Bell for Admin -->
                    @if(auth()->user()->isAdmin())
                        @include('components.admin-notifications')
                    @endif
                    
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative group">
                        <i class="fas fa-shopping-cart text-2xl text-gray-300 group-hover:text-accent transition-colors duration-300"></i>
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-3 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center animate-bounce">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-300 hover:text-accent transition-colors duration-300">
                            <i class="fas fa-user-circle text-2xl"></i>
                            <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300" :class="{'rotate-180': open}"></i>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0" 
                             class="absolute right-0 mt-2 w-48 glass-card rounded-lg shadow-xl py-1 z-50"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-primary-light/20 transition-colors duration-200">
                                <i class="fas fa-user mr-2"></i> My Profile
                            </a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm hover:bg-primary-light/20 transition-colors duration-200">
                                <i class="fas fa-truck mr-2"></i> My Orders
                            </a>
                            <div class="border-t border-primary-light/30 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-primary-light/20 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-accent transition-colors duration-300">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                @endauth
            </div>
        </div>
        
        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
            <button @click="open = !open" class="text-gray-300 hover:text-accent focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div x-show="open" @click.away="open = false" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="md:hidden glass-card mt-2 mx-4 rounded-lg shadow-xl"
         style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                <i class="fas fa-home mr-2"></i> Home
            </a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                <i class="fas fa-box-open mr-2"></i> Products
            </a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                <i class="fas fa-info-circle mr-2"></i> About
            </a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                <i class="fas fa-envelope mr-2"></i> Contact
            </a>
            <a href="{{ route('help') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                <i class="fas fa-question-circle mr-2"></i> Help
            </a>
            
            @auth
                <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                    <i class="fas fa-truck mr-2"></i> My Orders
                </a>
                <a href="{{ route('cart.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                    <i class="fas fa-shopping-cart mr-2"></i> Cart
                </a>
                
                @if(auth()->user()->isAdmin())
                    <div class="border-t border-primary-light/30 my-2"></div>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                        <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                        <i class="fas fa-boxes mr-2"></i> Manage Products
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                        <i class="fas fa-shopping-cart mr-2"></i> Manage Orders
                    </a>
                @endif
                
                <div class="border-t border-primary-light/30 my-2"></div>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            @else
                <div class="border-t border-primary-light/30 my-2"></div>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-accent hover:bg-primary-light/10 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Spacer for fixed nav -->
<div class="h-16"></div>