@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Siparişlerim ve Faturalar</h1>
        <p class="mt-1 text-sm text-gray-500">Geçmiş satın alımlarınızı ve güncel sipariş durumlarınızı buradan takip edebilirsiniz.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if(count($orders) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Sipariş No</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tarih</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tutar</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Durum</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">İşlem</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-indigo-600">{{ $order->order_number }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-extrabold text-gray-900">{{ number_format($order->total_amount, 2) }} ₺</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->status == 'paid')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">Ödendi / Aktif</span>
                                @elseif($order->status == 'pending')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">Ödeme Bekliyor</span>
                                @elseif($order->status == 'failed')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800">Hata (Kurulum)</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-800">İptal Edildi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('client.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold bg-indigo-50 px-3 py-2 rounded-lg">Faturayı Gör</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                <h3 class="text-lg font-medium text-gray-900">Henüz siparişiniz bulunmuyor</h3>
                <p class="mt-1 text-gray-500">Hosting paketlerimizi inceleyerek hemen bir proje başlatabilirsiniz.</p>
                <div class="mt-6">
                    <a href="{{ route('client.hosting.index') }}" class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-xl shadow-sm hover:bg-indigo-700">Paketleri İncele</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection