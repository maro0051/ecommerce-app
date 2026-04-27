<div id="authModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" id="authModalBackdrop"></div>
    
    <!-- Modal -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-md transform overflow-hidden rounded-2xl glass-card p-6 shadow-xl transition-all">
            
            <!-- Close Button -->
            <button onclick="closeAuthModal()" class="absolute right-4 top-4 text-gray-400 hover:text-accent transition-colors">
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
                <button onclick="switchTab('login')" id="loginTabBtn" class="flex-1 pb-3 text-center transition-all duration-300 text-accent border-b-2 border-accent">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
                <button onclick="switchTab('register')" id="registerTabBtn" class="flex-1 pb-3 text-center transition-all duration-300 text-gray-400 hover:text-gray-300">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </button>
            </div>
            
            <!-- Login Form -->
            <div id="loginForm" class="space-y-4">
                <form method="POST" action="{{ route('login') }}" id="loginFormElement">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ url()->current() }}" id="redirectUrl">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2 text-accent"></i>
                            Email Address
                        </label>
                        <input type="email" name="email" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your email"
                               id="loginEmail">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2 text-accent"></i>
                            Password
                        </label>
                        <input type="password" name="password" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your password"
                               id="loginPassword">
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
            <div id="registerForm" class="space-y-4" style="display: none;">
                <form method="POST" action="{{ route('register') }}" id="registerFormElement">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ url()->current() }}">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user mr-2 text-accent"></i>
                            Full Name
                        </label>
                        <input type="text" name="name" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your full name"
                               id="registerName">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2 text-accent"></i>
                            Email Address
                        </label>
                        <input type="email" name="email" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Enter your email"
                               id="registerEmail">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2 text-accent"></i>
                            Password
                        </label>
                        <input type="password" name="password" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Choose a password"
                               id="registerPassword">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-check-circle mr-2 text-accent"></i>
                            Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" required 
                               class="w-full rounded-lg input-glow"
                               placeholder="Confirm your password"
                               id="registerPasswordConfirmation">
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
                    <span class="px-4 bg-primary-dark/50 text-gray-400">Or continue with</span>
                </div>
            </div>
            
            <!-- Guest Option -->
            <button onclick="closeAuthModal()" 
                    class="w-full bg-gray-700/50 text-gray-300 rounded-lg py-2 hover:bg-gray-700 transition-all">
                <i class="fas fa-shopping-bag mr-2"></i> Continue as Guest (Browse Only)
            </button>
        </div>
    </div>
</div>

<script>
// Global modal functions
function openAuthModal() {
    var modal = document.getElementById('authModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        switchTab('login');
    }
}

function closeAuthModal() {
    var modal = document.getElementById('authModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

function switchTab(tab) {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');
    var loginTabBtn = document.getElementById('loginTabBtn');
    var registerTabBtn = document.getElementById('registerTabBtn');
    
    if (tab === 'login') {
        if (loginForm) loginForm.style.display = 'block';
        if (registerForm) registerForm.style.display = 'none';
        if (loginTabBtn) {
            loginTabBtn.classList.add('text-accent', 'border-b-2', 'border-accent');
            loginTabBtn.classList.remove('text-gray-400');
        }
        if (registerTabBtn) {
            registerTabBtn.classList.remove('text-accent', 'border-b-2', 'border-accent');
            registerTabBtn.classList.add('text-gray-400');
        }
    } else {
        if (loginForm) loginForm.style.display = 'none';
        if (registerForm) registerForm.style.display = 'block';
        if (registerTabBtn) {
            registerTabBtn.classList.add('text-accent', 'border-b-2', 'border-accent');
            registerTabBtn.classList.remove('text-gray-400');
        }
        if (loginTabBtn) {
            loginTabBtn.classList.remove('text-accent', 'border-b-2', 'border-accent');
            loginTabBtn.classList.add('text-gray-400');
        }
    }
}

// Close modal when clicking backdrop
document.addEventListener('DOMContentLoaded', function() {
    var backdrop = document.getElementById('authModalBackdrop');
    if (backdrop) {
        backdrop.addEventListener('click', closeAuthModal);
    }
    
    // Handle ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('authModal');
            if (modal && modal.style.display === 'block') {
                closeAuthModal();
            }
        }
    });
});

// Make functions globally available
window.openAuthModal = openAuthModal;
window.closeAuthModal = closeAuthModal;
window.switchTab = switchTab;
</script>