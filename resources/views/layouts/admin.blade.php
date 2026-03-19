<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Süper Admin | Global Dijital Altyapı</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden font-sans" x-data="{ mobileMenuOpen: false }">

    <div x-show="mobileMenuOpen" x-cloak @click="mobileMenuOpen = false" class="fixed inset-0 z-40 bg-black/50 md:hidden"></div>

    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'" class="w-64 bg-slate-900 text-slate-300 flex flex-col h-full shadow-2xl z-50 fixed inset-y-0 left-0 transform transition-transform duration-300 ease-in-out md:static md:translate-x-0">
        
        <div class="h-16 flex items-center justify-between px-6 bg-slate-950 border-b border-slate-800">
            <div class="flex items-center">
                <svg class="h-8 w-8 text-emerald-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="text-lg font-bold tracking-wider text-white">SÜPER ADMIN</span>
            </div>
            <button @click="mobileMenuOpen = false" class="md:hidden text-slate-400 hover:text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Genel Bakış
            </a>

            <div class="pt-6 pb-2"><p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Müşteri & Finans</p></div>

            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                Müşteriler
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                Sipariş Yönetimi
            </a>

            <div class="pt-6 pb-2"><p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Altyapı & API</p></div>

            <a href="{{ route('admin.providers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.providers.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                API Sağlayıcıları
            </a>
            <a href="{{ route('admin.domain-prices.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.domain-prices.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Fiyat Senkronizasyonu
            </a>
            <a href="{{ route('admin.monitoring.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.monitoring.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                Sistem Monitörü
            </a>

            <div class="pt-6 pb-2"><p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Log & Destek</p></div>

            <a href="{{ route('admin.webhooks.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.webhooks.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                Webhook Logları
            </a>
            <a href="{{ route('admin.tickets.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.tickets.*') ? 'bg-emerald-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Destek Talepleri
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800 bg-slate-950">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm font-bold text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition-colors">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Sistemden Çık
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="h-16 bg-white shadow-sm border-b border-gray-200 flex items-center justify-between px-6 z-10">
            
            <div class="flex items-center">
                <button @click="mobileMenuOpen = true" class="md:hidden mr-4 text-gray-500 hover:text-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="bg-red-100 text-red-800 text-xs font-extrabold px-3 py-1 rounded-full border border-red-200 uppercase tracking-widest hidden sm:block">
                    Yönetici Modu
                </span>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('client.dashboard') }}" target="_blank" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 items-center hidden sm:flex">
                    Müşteri Paneline Git
                    <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
                <div class="border-l border-gray-200 h-6 mx-2 hidden sm:block"></div>
                <div class="flex items-center">
                    <div class="h-9 w-9 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-md">
                        {{ strtoupper(substr(Auth::user()?->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 md:p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>