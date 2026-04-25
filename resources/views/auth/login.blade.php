<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Commerce') }} - Login</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #0a192f;
            --primary: #1e3a8a;
            --primary-light: #3b82f6;
            --accent: #00d4ff;
            --text-light: #f3f4f6;
            --text-muted: #9ca3af;
            --danger: #ef4444;
        }

        body {
            background: linear-gradient(135deg, #0a192f 0%, #0f172a 50%, #1e1b4b 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(31, 41, 55, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 24px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 12px 24px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
        }

        .btn-primary:hover {
            transform: scale(1.02);
            box-shadow: 0 0 20px #00d4ff;
        }

        .input-glow {
            background: rgba(31, 41, 55, 0.8);
            border: 1px solid #3b82f6;
            color: #f3f4f6;
            border-radius: 12px;
            padding: 12px 16px;
            width: 100%;
        }

        .input-glow:focus {
            outline: none;
            border-color: #00d4ff;
            box-shadow: 0 0 10px #00d4ff;
        }

        .gradient-text {
            background: linear-gradient(135deg, #00d4ff 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="glass-card p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-accent/20 mb-4">
                        <i class="fas fa-store text-4xl text-accent"></i>
                    </div>
                    <h2 class="text-3xl font-bold gradient-text">Welcome Back</h2>
                    <p class="text-gray-400 mt-2">Login to your account</p>
                </div>

                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-500/20 border border-red-500 rounded-lg text-red-400 text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-500/20 border border-green-500 rounded-lg text-green-400 text-sm">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="input-glow @error('email') border-red-500 @enderror"
                               placeholder="admin@example.com" required autofocus>
                        @error('email')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" 
                               class="input-glow @error('password') border-red-500 @enderror"
                               placeholder="··········" required>
                        @error('password')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-primary-light/30 bg-transparent">
                            <span class="ml-2 text-sm text-gray-400">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-accent hover:text-accent-light">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                    </button>
                </form>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-primary-light/30"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-primary-dark/50 text-gray-400">New to our store?</span>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-accent hover:text-accent-light font-semibold">
                        Create an Account
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="mt-6 p-4 bg-accent/5 rounded-lg border border-accent/20">
                    <p class="text-xs text-center text-gray-400 mb-2">📝 Demo Credentials:</p>
                    <div class="text-xs text-gray-500 space-y-1">
                        <div class="flex justify-between">
                            <span>👑 Admin:</span>
                            <span class="text-accent">admin@example.com / password</span>
                        </div>
                        <div class="flex justify-between">
                            <span>👤 Customer:</span>
                            <span class="text-accent">customer@example.com / password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>