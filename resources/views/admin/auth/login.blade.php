<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login • Strengthlink</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 
                            50: '#fdf2f8', 
                            100: '#fce7f3', 
                            200: '#fbcfe8', 
                            300: '#f9a8d4', 
                            400: '#f472b6', 
                            500: '#ec4899', 
                            600: '#db2777', 
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843'
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a'
                        }
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'glow': '0 0 20px rgba(236, 72, 153, 0.15)',
                        'card': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                        'float': 'float 6s ease-in-out infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fdf2f8 0%, #f8fafc 50%, #f0f9ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .gradient-text {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 50%, #be185d 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
            border-color: #ec4899;
        }
        .checkbox:checked {
            background-color: #ec4899;
            border-color: #ec4899;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-primary-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Login Container -->
    <div class="w-full max-w-md animate-fade-in">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center mx-auto mb-4 shadow-glow">
                <i class="fas fa-lock text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold gradient-text mb-2">Admin Portal</h1>
            <p class="text-secondary-600">Sign in to access the admin dashboard</p>
        </div>

        <!-- Login Card -->
        <div class="glass-effect rounded-2xl shadow-card p-8">
            @if (session('status'))
                <div class="mb-6 rounded-xl bg-blue-50 p-4 text-blue-700 border border-blue-200 flex items-center">
                    <i class="fas fa-info-circle mr-3 text-blue-500"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 p-4 text-red-700 border border-red-200">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span class="font-medium">Please check the following:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-secondary-700 mb-2">
                        <i class="fas fa-envelope text-primary-500 mr-2"></i>
                        Email Address
                    </label>
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               class="form-input w-full rounded-xl border-gray-200 focus:border-primary-400 py-3 px-4 pl-11 bg-white transition-all duration-200"
                               placeholder="admin@example.com">
                        <i class="fas fa-envelope absolute left-3 top-3.5 text-secondary-400"></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-secondary-700 mb-2">
                        <i class="fas fa-lock text-primary-500 mr-2"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               required
                               class="form-input w-full rounded-xl border-gray-200 focus:border-primary-400 py-3 px-4 pl-11 bg-white transition-all duration-200"
                               placeholder="Enter your password">
                        <i class="fas fa-lock absolute left-3 top-3.5 text-secondary-400"></i>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" 
                                   name="remember" 
                                   value="1"
                                   class="checkbox sr-only">
                            <div class="w-5 h-5 border-2 border-gray-300 rounded-md flex items-center justify-center transition-all duration-200">
                                <i class="fas fa-check text-white text-xs opacity-0 transition-opacity duration-200"></i>
                            </div>
                        </div>
                        <span class="text-sm text-secondary-700">Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 py-3.5 px-4 text-white font-medium hover:shadow-glow transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign in to Admin
                </button>
            </form>

            <!-- Back Link -->
            <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center text-sm text-secondary-600 hover:text-primary-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to main site
                </a>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="mt-6 text-center">
            <p class="text-xs text-secondary-500 flex items-center justify-center">
                <i class="fas fa-shield-alt mr-1.5"></i>
                Secure admin access • Authorized personnel only
            </p>
        </div>
    </div>

    <script>
        // Enhanced checkbox functionality
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.checkbox');
            
            checkboxes.forEach(checkbox => {
                const container = checkbox.parentElement;
                
                // Set initial state
                if (checkbox.checked) {
                    container.classList.add('bg-primary-500', 'border-primary-500');
                    container.querySelector('i').classList.remove('opacity-0');
                }
                
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        container.classList.add('bg-primary-500', 'border-primary-500');
                        container.querySelector('i').classList.remove('opacity-0');
                    } else {
                        container.classList.remove('bg-primary-500', 'border-primary-500');
                        container.querySelector('i').classList.add('opacity-0');
                    }
                });
            });

            // Add floating animation to form inputs on focus
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('transform', 'scale-105');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('transform', 'scale-105');
                });
            });
        });
    </script>
</body>
</html>
