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

        /* Glass Card Effect */
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

        /* Button Styles */
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

        /* Input Fields */
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

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .page-transition {
            animation: fadeInUp 0.5s ease-out;
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.15);
        }

        /* Navigation */
        .nav-glow {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        /* Scrollbar */
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

    <!-- Auth Modal Component -->
    @include('components.auth-modal')

    <!-- Global Functions - Make sure openAuthModal is available everywhere -->
    <script>
        // Define the function globally
        window.openAuthModal = function() {
            console.log('openAuthModal called');
            var modal = document.getElementById('authModal');
            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
                // Reset to login tab
                if (typeof switchTab === 'function') {
                    switchTab('login');
                }
            } else {
                console.error('Modal not found');
                // Fallback: redirect to login page
                window.location.href = '{{ route("login") }}?redirect=' + encodeURIComponent(window.location.href);
            }
        };
        
        window.closeAuthModal = function() {
            var modal = document.getElementById('authModal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        };
        
        // Make sure the function is also available on the window object
        window.openLoginModal = window.openAuthModal;
        
        console.log('Global functions registered - openAuthModal available');
    </script>
</body>
</html>
</body>
</html>