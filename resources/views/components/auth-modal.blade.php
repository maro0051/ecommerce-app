<div x-data="{ showAuthModal: false, activeTab: 'login' }" 
     x-show="showAuthModal" 
     x-cloak
     @open-auth-modal.window="showAuthModal = true"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity"
         @click="showAuthModal = false"></div>
    
    <!-- Modal -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-md transform overflow-hidden rounded-2xl glass-card p-6 shadow-xl transition-all"
             x-show="showAuthModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4">
            
            <!-- Close Button -->
            <button @click="showAuthModal = false" class="absolute right-4 top-4 text-gray-400 hover:text-accent transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <!-- Header -->
            <div class="text-center mb-6">
                <i class="fas fa-shopping-cart text-5xl text-accent mb-3"></i>
                <h2 class="text-2xl font-bold gradient-text">Welcome Back!</h2>
                <p class="text-gray-400 mt-2">Login or register to continue shopping</p>
            </div>
            
            <!-- Tab Buttons -->
            <div class="flex gap-2 mb-6 border-b border-primary-light/30">
                <button @click="activeTab = 'login'" 
                        class="flex-1 pb-3 text-center transition-all duration-300"
                        :class="activeTab === 'login' ? 'text-accent border-b-2 border-accent' : 'text-gray-400 hover:text-gray-300'">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
                <button @click="activeTab = 'register'" 
                        class="flex-1 pb-3 text-center transition-all duration-300"
                        :class="activeTab === 'register' ? 'text-accent border-b-2 border-accent' : 'text-gray-400 hover:text-gray-300'">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </button>
            </div>
            
            <!-- Login Form -->
            <div x-show="activeTab === 'login'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your email">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your password">
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-primary-light/30 bg-transparent">
                            <span class="ml-2 text-sm text-gray-400">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-accent hover:text-accent-light">
                            Forgot password?
                        </a>
                    </div>
                    <button type="submit" class="w-full btn-primary rounded-lg py-2 mt-4">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </button>
                </form>
            </div>
            
            <!-- Register Form -->
            <div x-show="activeTab === 'register'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input type="text" name="name" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your full name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your email">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Choose a password">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Confirm your password">
                    </div>
                    <button type="submit" class="w-full btn-primary rounded-lg py-2 mt-4">
                        <i class="fas fa-user-plus mr-2"></i> Create Account
                    </button>
                </form>
            </div>
            
            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-primary-light/30"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-primary-dark/50 text-gray-400">Or continue with</span>
                </div>
            </div>
            
            <!-- Guest Checkout Option -->
            <button @click="showAuthModal = false" 
                    class="w-full bg-gray-700/50 text-gray-300 rounded-lg py-2 hover:bg-gray-700 transition-all">
                <i class="fas fa-shopping-bag mr-2"></i> Continue as Guest (Browse Only)
            </button>
        </div>
    </div>
</div>