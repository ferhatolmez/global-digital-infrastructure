@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Sistem Genel Bakış</h1>
            <p class="text-gray-500 mt-1">Global Altyapı Platformu Gerçek Zamanlı Verileri</p>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            Son Güncelleme: {{ now()->format('H:i:s') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-100 rounded-xl"><svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded">+12%</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Toplam Ciro</h3>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_revenue'], 2) }} ₺</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-indigo-100 rounded-xl"><svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" /></svg></div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Aktif Hizmetler</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['active_services'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition border-l-4 border-l-yellow-400">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-yellow-100 rounded-xl"><svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Bekleyen Ödemeler</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_orders'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition border-l-4 border-l-red-400">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-red-100 rounded-xl"><svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg></div>
                <span class="text-xs font-bold text-red-600 animate-pulse">KRİTİK</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Kurulum Hataları</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['failed_provisioning'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">API Sağlayıcıları Sağlık Raporu</h3>
                    <a href="{{ route('admin.providers.index') }}" class="text-indigo-600 text-sm font-medium hover:underline">Tümünü Yönet &rarr;</a>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($providerHealth as $p)
                        <div class="flex items-center justify-between p-4 rounded-xl border {{ $p->is_active ? 'border-gray-100 bg-white' : 'border-red-100 bg-red-50' }}">
                            <div class="flex items-center space-x-3">
                                <div class="h-3 w-3 rounded-full {{ $p->is_active ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">{{ $p->name }}</p>
                                    <p class="text-xs text-gray-500 uppercase">{{ $p->service_type }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400">Son Bağlantı</p>
                                <p class="text-sm font-medium text-gray-700">{{ $p->last_connected_at ? $p->last_connected_at->diffForHumans() : 'Hiç bağlanmadı' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">Canlı Webhook Akışı</h3>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach($recentWebhooks as $index => $log)
                            <li>
                                <div class="relative pb-8">
                                    @if($index !== count($recentWebhooks) - 1)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white {{ $log->status == 'processed' ? 'bg-green-500' : 'bg-red-500' }}">
                                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    @if($log->status == 'processed')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    @endif
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $log->event_type }} <span class="font-medium text-gray-900">{{ $log->order_number }}</span></p>
                                            </div>
                                            <div class="text-right text-xs whitespace-nowrap text-gray-500">
                                                <time>{{ $log->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection