<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Commerce') }} - Register</title>
    
    <!-- Fonts and Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Same styles as login page */
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
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .waves {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%2300d4ff' fill-opacity='0.05' d='M0,192L48,197.3C96,203,192,213,288,208C384,203,480,181,576,181.3C672,181,768,203,864,218.7C960,235,1056,245,1152,234.7C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") repeat-x bottom;
            background-size: cover;
            animation: waveAnimation 20s linear infinite;
            opacity: 0.5;
        }

        .wave:nth-child(2) {
            bottom: 10px;
            opacity: 0.3;
            animation: waveAnimation 15s linear infinite reverse;
        }

        .wave:nth-child(3) {
            bottom: 20px;
            opacity: 0.1;
            animation: waveAnimation 25s linear infinite;
        }

        @keyframes waveAnimation {
            0% {
                background-position-x: 0;
            }
            100% {
                background-position-x: 1440px;
            }
        }

        .particle {
            position: absolute;
            background: var(--accent);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 6s infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-20px) translateX(10px);
                opacity: 0.6;
            }
        }

        .glass-card {
            background: rgba(31, 41, 55, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 24px;
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
            padding: 12px 24px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
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
            transform: scale(1.02);
            box-shadow: 0 0 20px var(--accent);
        }

        .btn-google {
            background: linear-gradient(135deg, #db4437 0%, #c53929 100%);
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
            gap: 12px;
            width: 100%;
        }

        .btn-google:hover {
            transform: scale(1.02);
            box-shadow: 0 0 20px #db4437;
        }

        .btn-apple {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
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
            gap: 12px;
            width: 100%;
        }

        .btn-apple:hover {
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .input-glow {
            background: rgba(31, 41, 55, 0.8);
            border: 1px solid var(--primary-light);
            color: var(--text-light);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .input-glow:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 10px var(--accent);
            background: rgba(31, 41, 55, 0.9);
        }

        .input-glow::placeholder {
            color: var(--text-muted);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        @keyframes shine {
            0% {
                background-position: -100%;
            }
            100% {
                background-position: 200%;
            }
        }

        .shine {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            background-size: 200% 100%;
            animation: shine 3s infinite;
        }

        .social-icon {
            transition: transform 0.3s ease;
        }

        .btn-google:hover .social-icon,
        .btn-apple:hover .social-icon {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="waves">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="glass-card p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-accent/20 mb-4 shine">
                        <i class="fas fa-user-plus text-4xl text-accent"></i>
                    </div>
                    <h2 class="text-3xl font-bold gradient-text">Create Account</h2>
                    <p class="text-gray-400 mt-2">Join our community today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user mr-2 text-accent"></i>
                            Full Name
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               class="input-glow @error('name') border-danger @enderror"
                               placeholder="John Doe"
                               required>
                        @error('name')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2 text-accent"></i>
                            Email Address
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               class="input-glow @error('email') border-danger @enderror"
                               placeholder="hello@example.com"
                               required>
                        @error('email')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2 text-accent"></i>
                            Password
                        </label>
                        <input type="password" 
                               name="password" 
                               class="input-glow @error('password') border-danger @enderror"
                               placeholder="Create a password"
                               required>
                        @error('password')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-check-circle mr-2 text-accent"></i>
                            Confirm Password
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="input-glow"
                               placeholder="Confirm your password"
                               required>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" required 
                               class="w-4 h-4 rounded border-primary-light/30 bg-transparent text-accent focus:ring-accent">
                        <span class="ml-2 text-sm text-gray-400">
                            I agree to the 
                            <a href="#" class="text-accent hover:text-accent-light">Terms of Service</a>
                            and 
                            <a href="#" class="text-accent hover:text-accent-light">Privacy Policy</a>
                        </span>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create Account
                    </button>
                </form>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-primary-light/30"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-primary-dark/50 text-gray-400">Or sign up with</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="https://accounts.google.com/signup" 
                       target="_blank"
                       class="btn-google">
                        <i class="fab fa-google fa-lg social-icon"></i>
                        Sign up with Google
                    </a>
                    
                    <a href="https://appleid.apple.com/account" 
                       target="_blank"
                       class="btn-apple">
                        <i class="fab fa-apple fa-lg social-icon"></i>
                        Sign up with Apple
                    </a>
                </div>

                <div class="text-center mt-8">
                    <p class="text-gray-400">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-accent hover:text-accent-light font-semibold ml-1 group">
                            Sign In
                            <i class="fas fa-arrow-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            if (!particlesContainer) return;
            
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 5 + 's';
                particle.style.animationDuration = Math.random() * 3 + 4 + 's';
                particlesContainer.appendChild(particle);
            }
        }
        
        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>