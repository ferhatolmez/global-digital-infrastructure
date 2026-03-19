@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Fiyat & Kur Senkronizasyonu</h1>
        <p class="mt-1 text-sm text-gray-500">Domain, Hosting ve diğer hizmetlerin fiyatlarını global API'lerden ve güncel döviz kurlarından çekerek güncelleyin.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-md whitespace-pre-line">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Manuel Fiyat Senkronizasyonu</h3>
                <p class="text-sm text-gray-500 mt-1">Sistem her gece 02:00'da otomatik senkronize olur. Acil durumlarda buradan manuel tetikleyebilirsiniz.</p>
            </div>
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    Cron: Aktif
                </span>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="border rounded-lg p-4 flex items-start space-x-4 bg-indigo-50 border-indigo-100">
                    <svg class="h-8 w-8 text-indigo-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <div>
                        <h4 class="font-bold text-gray-900">Güncel Kur Kontrolü</h4>
                        <p class="text-sm text-gray-600">TCMB veya Serbest Piyasa döviz kurları çekilerek sisteme işlenir.</p>
                    </div>
                </div>
                
                <div class="border rounded-lg p-4 flex items-start space-x-4 bg-blue-50 border-blue-100">
                    <svg class="h-8 w-8 text-blue-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                    <div>
                        <h4 class="font-bold text-gray-900">Domain API Fiyatları</h4>
                        <p class="text-sm text-gray-600">Aktif sağlayıcı (Örn: Namecheap) üzerinden uzantı bazlı maliyetler çekilir.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.prices.sync-now') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-lg shadow-lg transition-colors flex justify-center items-center text-lg">
                    <svg class="h-6 w-6 mr-2 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Şimdi Senkronize Et
                </button>
            </form>
        </div>
    </div>
</div>
@endsection