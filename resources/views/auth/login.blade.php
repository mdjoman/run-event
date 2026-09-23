<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Run Burjowan Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { brandPink: '#e11d48' } } }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-brandPink min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="bg-gradient-to-r from-brandPink to-pink-700 px-8 py-6 text-center">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-14 w-14 mx-auto bg-white rounded-full p-1 mb-3">
            <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            <p class="text-pink-100 text-sm mt-1">Sign in to continue</p>
        </div>

        <div class="p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-5 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        <i class="fa-regular fa-envelope text-brandPink mr-1"></i> Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@runburjowan.com"
                           class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">
                        <i class="fa-solid fa-lock text-brandPink mr-1"></i> Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                               placeholder="••••••••"
                               class="w-full px-4 py-2.5 pr-10 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700">
                            <i id="eyeIcon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-slate-600">
                        <input type="checkbox" name="remember" class="mr-2 rounded"> Remember me
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-brandPink text-white py-3 rounded-lg font-semibold hover:bg-pink-700 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i> Sign In
                </button>
            </form>

            <p class="text-center text-xs text-slate-400 mt-6">
                © <span id="year"></span> Run Burjowan. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();

        function togglePassword() {
            const input = document.getElementById('password');
            const icon  = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>