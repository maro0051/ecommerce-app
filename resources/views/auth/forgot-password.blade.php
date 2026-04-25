<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Commerce') }} - Reset Password</title>
    
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
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
            transition: all 0.3s ease;
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
                        <i class="fas fa-key text-4xl text-accent"></i>
                    </div>
                    <h2 class="text-3xl font-bold gradient-text">Reset Password</h2>
                    <p class="text-gray-400 mt-2">We'll send you a reset link</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-400 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2 text-accent"></i>
                            Email Address
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="input-glow @error('email') border-red-500 @enderror"
                               placeholder="Enter your registered email">
                        @error('email')
                            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Reset Link
                    </button>
                </form>

                <div class="btn-primary mt-6 bg-transparent border border-accent text-accent hover:bg-accent hover:text-white">
                    <a href="{{ route('login') }}" class="text-accent hover:text-accent-light transition-colors inline-flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>