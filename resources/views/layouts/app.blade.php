<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'E-Commerce'))</title>
    
    <!-- Fonts and Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Dark Blue Theme with Animations */
        :root {
            --primary-dark: #0a192f;
            --primary: #1e3a8a;
            --primary-light: #3b82f6;
            --accent: #00d4ff;
            --accent-glow: #00d4ff33;
            --text-light: #f3f4f6;
            --text-muted: #9ca3af;
            --card-bg: #1f2937;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a192f 0%, #0f172a 50%, #1e1b4b 100%);
            color: var(--text-light);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(31, 41, 55, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
            box-shadow: 0 12px 48px rgba(0, 212, 255, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 100%);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px var(--accent);
        }

        .input-glow {
            background: rgba(31, 41, 55, 0.8);
            border: 1px solid var(--primary-light);
            color: var(--text-light);
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .input-glow:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 10px var(--accent);
            background: rgba(31, 41, 55, 0.9);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-glow {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--primary-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
        }
    </style>
</head>
<body>
    <div class="relative z-10">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-primary-dark/50 backdrop-blur-md shadow-lg border-b border-primary-light/30">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="page-transition">
            @if(session('success'))
                <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                    <div class="bg-green-500/20 border border-green-500 text-green-400 px-4 py-3 rounded-lg relative" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                    <div class="bg-red-500/20 border border-red-500 text-red-400 px-4 py-3 rounded-lg relative" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if(session('warning'))
                <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                    <div class="bg-yellow-500/20 border border-yellow-500 text-yellow-400 px-4 py-3 rounded-lg relative" role="alert">
                        <i class="fas fa-clock mr-2"></i>
                        <span class="block sm:inline">{{ session('warning') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Session Timer Display for Authenticated Users -->
    @auth
    <div class="fixed bottom-4 left-4 z-50">
        <div class="glass-card px-4 py-2 text-sm flex items-center gap-2">
            <i class="fas fa-hourglass-half text-accent"></i>
            <span>Session expires in: <span id="sessionTimer" class="font-mono text-accent font-bold">10:00</span></span>
        </div>
    </div>
    @endauth

    <!-- Inactivity Timer Script -->
    <script>
        // Inactivity timeout in milliseconds (10 minutes)
        const INACTIVITY_TIMEOUT = 10 * 60 * 1000;
        let inactivityTimer;
        let countdownInterval;
        let warningModal = null;
        
        // Function to reset the inactivity timer
        function resetInactivityTimer() {
            if (inactivityTimer) {
                clearTimeout(inactivityTimer);
            }
            inactivityTimer = setTimeout(() => {
                showInactivityWarning();
            }, INACTIVITY_TIMEOUT);
        }
        
        // Function to show warning before logout
        function showInactivityWarning() {
            if (warningModal) return;
            
            const modalHtml = `
                <div id="inactivityModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background: rgba(0,0,0,0.8);">
                    <div class="glass-card max-w-md w-full p-6 text-center">
                        <div class="w-20 h-20 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-4xl text-yellow-500"></i>
                        </div>
                        <h3 class="text-xl font-bold gradient-text mb-3">Session Expiring Soon</h3>
                        <p class="text-gray-300 mb-4">You have been inactive for 10 minutes. For security reasons, you will be logged out.</p>
                        <div class="flex gap-3">
                            <button onclick="stayLoggedIn()" class="flex-1 btn-primary">
                                <i class="fas fa-check mr-2"></i> Stay Logged In
                            </button>
                            <button onclick="logoutNow()" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 mt-4">You will be logged out in <span id="countdown">30</span> seconds</p>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            warningModal = document.getElementById('inactivityModal');
            
            let seconds = 30;
            const countdownElement = document.getElementById('countdown');
            countdownInterval = setInterval(() => {
                seconds--;
                if (countdownElement) {
                    countdownElement.textContent = seconds;
                }
                if (seconds <= 0) {
                    clearInterval(countdownInterval);
                    logoutNow();
                }
            }, 1000);
        }
        
        // Function to stay logged in
        function stayLoggedIn() {
            if (warningModal) {
                warningModal.remove();
                warningModal = null;
            }
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
            
            fetch('/keep-alive', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                if (response.ok) {
                    resetInactivityTimer();
                    updateSessionTimer();
                }
            });
        }
        
        // Function to logout immediately
        function logoutNow() {
            if (warningModal) {
                warningModal.remove();
                warningModal = null;
            }
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
            
            const logoutForm = document.createElement('form');
            logoutForm.method = 'POST';
            logoutForm.action = '/logout';
            logoutForm.innerHTML = '<input type="hidden" name="_token" value="' + document.querySelector('meta[name="csrf-token"]').getAttribute('content') + '">';
            document.body.appendChild(logoutForm);
            logoutForm.submit();
        }
        
        // Update session timer display
        function updateSessionTimer() {
            fetch('/session-time')
                .then(response => response.json())
                .then(data => {
                    const minutes = Math.floor(data.remaining / 60);
                    const seconds = data.remaining % 60;
                    const timerElement = document.getElementById('sessionTimer');
                    if (timerElement) {
                        timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                    }
                })
                .catch(err => console.log('Timer update failed'));
        }
        
        // Track user activity events
        const activityEvents = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click', 'keydown'];
        
        function resetTimer() {
            resetInactivityTimer();
            
            fetch('/ping', {
                method: 'HEAD',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).catch(err => console.log('Ping failed'));
        }
        
        activityEvents.forEach(eventName => {
            document.addEventListener(eventName, resetTimer);
        });
        
        document.addEventListener('DOMContentLoaded', () => {
            resetInactivityTimer();
            if (document.getElementById('sessionTimer')) {
                updateSessionTimer();
                setInterval(updateSessionTimer, 1000);
            }
        });
        
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                resetTimer();
            }
        });
    </script>
</body>
</html>