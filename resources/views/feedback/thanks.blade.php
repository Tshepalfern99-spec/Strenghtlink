<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You - Strenghtlink</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
                        },
                        purple: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            500: '#a855f7',
                            600: '#9333ea'
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
                        'bounce-gentle': 'bounceGentle 2s infinite'
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
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
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
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-text {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 50%, #be185d 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1), 0 0 20px rgba(236, 72, 153, 0.1);
            border-color: #fbcfe8;
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

    <!-- Thank You Container -->
    <div class="w-full max-w-2xl animate-fade-in">
        <!-- Thank You Card -->
        <div class="glass-effect rounded-2xl shadow-card p-12 text-center card-hover">
            <!-- Animated Icon -->
            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center mx-auto mb-8 animate-bounce-gentle">
                <i class="fas fa-heart text-white text-3xl"></i>
            </div>

            <!-- Message -->
            <h1 class="text-4xl font-black gradient-text mb-4">Thank You!</h1>
            <p class="text-xl text-secondary-600 mb-8 leading-relaxed">
                We truly appreciate your feedback—it helps us improve Strengthlink for everyone in our community.
            </p>

            <!-- Additional Info -->
            <div class="bg-primary-50 rounded-2xl p-6 mb-8 border border-primary-100">
                <div class="flex items-center justify-center gap-2 text-primary-700 mb-2">
                    <i class="fas fa-lightbulb"></i>
                    <span class="font-semibold">Your voice matters</span>
                </div>
                <p class="text-secondary-600 text-sm">
                    Every piece of feedback helps us create a better, safer experience for our community members.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-4 text-white font-semibold hover:shadow-glow transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-home"></i>
                    Back to Home
                </a>
                <a href="/my/feedback" 
                   class="inline-flex items-center gap-2 rounded-xl border border-primary-500 px-8 py-4 text-primary-600 font-semibold hover:bg-primary-50 transition-all duration-200">
                    <i class="fas fa-star"></i>
                    View My Feedback
                </a>
            </div>

            <!-- Quick Links -->
            <div class="mt-8 pt-8 border-t border-secondary-100">
                <p class="text-secondary-500 text-sm mb-4">Need help or want to explore more?</p>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="/resources" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 text-sm font-medium">
                        <i class="fas fa-hands-helping"></i>
                        Find Resources
                    </a>
                    <a href="/report/create" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 text-sm font-medium">
                        <i class="fas fa-flag"></i>
                        Report Incident
                    </a>
                    <a href="/forum" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 text-sm font-medium">
                        <i class="fas fa-comments"></i>
                        Community Forum
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <p class="text-xs text-secondary-500 flex items-center justify-center">
                <i class="fas fa-heart text-primary-400 mr-1.5"></i>
                Building stronger connections together
            </p>
        </div>
    </div>

    <!-- Floating Emergency Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="/resources?q=emergency" class="inline-flex items-center gap-3 rounded-full bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-white font-bold hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-2xl">
            <i class="fas fa-ambulance text-xl"></i>
            Emergency Help
        </a>
    </div>

    <script>
        // Add confetti effect on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Simple confetti effect
            const colors = ['#ec4899', '#db2777', '#be185d', '#a855f7', '#9333ea'];
            const confettiCount = 30;
            
            for (let i = 0; i < confettiCount; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'fixed pointer-events-none z-40';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.top = '-20px';
                    confetti.style.fontSize = Math.random() * 20 + 10 + 'px';
                    confetti.style.color = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.opacity = '0.7';
                    confetti.innerHTML = '✦';
                    confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
                    
                    document.body.appendChild(confetti);
                    
                    // Remove confetti after animation
                    setTimeout(() => {
                        confetti.remove();
                    }, 5000);
                }, i * 100);
            }

            // Add CSS for falling animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fall {
                    0% {
                        transform: translateY(0) rotate(0deg);
                        opacity: 0.7;
                    }
                    100% {
                        transform: translateY(100vh) rotate(360deg);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>`