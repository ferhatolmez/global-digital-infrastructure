@extends('layouts.client')

@section('content')
<div class="p-6 lg:p-10">
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-900">Genel Bakış</h1>
        <p class="text-gray-500 mt-1">Dijital varlıklarınızın güncel durumu ve son aktiviteleriniz.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-4 bg-indigo-50 rounded-xl mr-5">
                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Web Sitelerim</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $data['active_sites'] }} Adet</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-4 bg-emerald-50 rounded-xl mr-5">
                <svg class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Toplam Sipariş</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $data['total_orders'] }} Kayıt</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-4 bg-amber-50 rounded-xl mr-5">
                <svg class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Bekleyen Destek</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $data['open_tickets'] }} Mesaj</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-900 text-lg">Son Siparişlerim</h3>
                <a href="{{ route('client.orders.index') }}" class="text-sm text-indigo-600 font-bold hover:underline">Tümünü Gör</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Tutar</th>
                            <th class="px-6 py-4">Durum</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($data['recent_orders'] as $order)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $order->order_number }}</td>
                                <td class="px-6 py-4">{{ number_format($order->total_amount, 2) }} ₺</td>
                                <td class="px-6 py-4">
                                    @if($order->status == 'paid')
                                        <span class="text-green-600 font-bold text-xs">● Ödendi</span>
                                    @else
                                        <span class="text-amber-500 font-bold text-xs">● Bekliyor</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">Henüz bir siparişiniz bulunmuyor.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-indigo-600 rounded-2xl shadow-xl p-8 text-white">
            <h3 class="text-xl font-bold mb-4">Hızlı İşlemler</h3>
            <p class="text-indigo-100 text-sm mb-6">Yeni bir projeye başlamak veya domain sorgulamak için aşağıdaki butonları kullanabilirsiniz.</p>
            <div class="space-y-4">
                <a href="{{ route('client.domains.search') }}" class="block w-full text-center bg-white text-indigo-600 font-bold py-3 rounded-xl hover:bg-indigo-50 transition">
                    Domain Sorgula
                </a>
                <a href="{{ route('client.hosting.index') }}" class="block w-full text-center bg-indigo-500 text-white font-bold py-3 rounded-xl hover:bg-indigo-400 transition border border-indigo-400">
                    Hosting Paketleri
                </a>
            </div>
        </div>
    </div>
</div>
@endsection