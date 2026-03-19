<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - Global Dijital Altyapı</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-indigo-900">Global Altyapı</h1>
            <p class="text-gray-500 mt-2">Dijital varlıklarınızı yönetin</p>
        </div>

        @yield('content')
        
    </div>

</body>
</html>