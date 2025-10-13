<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Additional Font for better typography -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --primary-pink: #ec4899;
                --secondary-pink: #db2777;
                --light-pink: #fdf2f8;
                --dark-pink: #be185d;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased" style="font-family: 'Inter', sans-serif;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
            <!-- Pink decorative elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-pink-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-64 h-64 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
            
            <div class="relative z-10">
                @if(file_exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" 
                     alt="StrenghtLink" 
                     class="w-20 h-20 transition-transform duration-300 group-hover:scale-110 drop-shadow-lg">
            @else
                <!-- Fallback logo if image doesn't exist -->
                <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-700 rounded-2xl flex items-center justify-center shadow-lg transform rotate-6 transition-transform duration-300 group-hover:rotate-12 group-hover:scale-110">
                    <span class="text-white font-bold text-xl">SL</span>
                </div>
            @endif 
            </div>

            <div class="relative z-10 w-full sm:max-w-md mt-8 px-6 py-8 bg-white shadow-2xl rounded-2xl border border-pink-100 transition-all duration-300 hover:shadow-3xl">
                {{ $slot }}
            </div>
        </div>

        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
            .shadow-3xl {
                box-shadow: 0 25px 50px -12px rgba(236, 72, 153, 0.25);
            }
        </style>
    </body>
</html>