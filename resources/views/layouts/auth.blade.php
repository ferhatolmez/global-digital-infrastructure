<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Giriş Yap') - Global Dijital Altyapı</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black font-sans antialiased flex items-center justify-center min-h-screen text-zinc-100">

    <div class="relative w-full max-w-md p-6">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-zinc-950 border border-zinc-800 rounded-2xl mb-4 shadow-sm">
                <svg class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Global Altyapı</h1>
            <p class="text-zinc-400 mt-2">Dijital varlıklarınızı yönetin</p>
        </div>

        @yield('content')

    </div>

</body>
</html>