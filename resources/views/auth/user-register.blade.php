<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    
    <!-- Error Notification -->
    @if ($errors->any())
    <div class="w-full bg-red-500 text-white text-center py-4 px-6">
        <p class="text-lg">{{ $errors->first() }}</p>
    </div>
    @endif

    @if (session('error'))
    <div class="w-full bg-red-500 text-white text-center py-4 px-6">
        <p class="text-lg">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Main Content -->
    <div class="flex-1 flex items-center justify-center">
        <div class="w-full max-w-md px-6">
            <!-- Sign Up Title -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-semibold text-gray-900 mb-2">Sign Up</h1>
                <p class="text-gray-600 text-lg">Enter your email and password to login:</p>
            </div>

            <!-- Sign Up Form -->
            <form action="{{ route('user-register') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Email Input -->
                <div>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}"
                        class="w-full px-6 py-4 bg-gray-200 rounded-full text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 @error('email') ring-2 ring-red-500 @enderror"
                    >
                </div>

                <!-- Password Input -->
                <div>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        class="w-full px-6 py-4 bg-gray-200 rounded-full text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 @error('password') ring-2 ring-red-500 @enderror"
                    >
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Confirm Password" 
                        class="w-full px-6 py-4 bg-gray-200 rounded-full text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 @error('password_confirmation') ring-2 ring-red-500 @enderror"
                    >
                </div>

                <!-- Sign Up Button -->
                <div>
                    <button 
                        type="submit"
                        class="w-full px-6 py-4 bg-[#1E2D88] hover:bg-[#16226A] rounded-full text-white font-medium transition-colors"
                    >
                        Sign Up
                    </button>
                </div>
            </form>

            <!-- Divider with OR -->
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-4 text-gray-600 font-medium">OR</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <!-- Google Login Button -->
            <div>
                <a 
                    href="{{ route('login.google') }}"
                    class="w-full flex items-center justify-center px-6 py-4 bg-[#1E2D88] hover:bg-[#16226A] rounded-full text-white font-medium transition-colors"
                >
                    Google Login
                </a>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-gray-900 text-lg">
                    Already have account? 
                    <a href="{{ route('login') }}" class="underline hover:text-gray-600">Login here</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>