@extends('layouts.client')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('client.orders.index') }}" class="text-gray-400 hover:text-indigo-600 mr-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Sipariş Detayı</h1>
        </div>
        <button onclick="window.print()" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-xl transition flex items-center text-sm">
            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
            Yazdır / PDF
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden print:shadow-none print:border-none">
        <div class="p-8 border-b border-gray-100 bg-gray-50 flex justify-between items-start">
            <div>
                <h2 class="text-3xl font-extrabold text-indigo-600 tracking-wider">FATURA</h2>
                <p class="text-sm font-bold text-gray-500 mt-2">Sipariş No: {{ $order->order_number }}</p>
                <p class="text-sm text-gray-500">Tarih: {{ $order->created_at->format('d.m.Y H:i') }}</p>
            </div>
            <div class="text-right">
                <h3 class="font-bold text-gray-900">Global Dijital Altyapı A.Ş.</h3>
                <p class="text-sm text-gray-500">Teknoloji Vadisi, No: 42<br>İstanbul / Türkiye<br>VD: Marmara - 1234567890</p>
            </div>
        </div>

        <div class="p-8 border-b border-gray-100 flex justify-between">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Fatura Edilen</p>
                <h4 class="font-bold text-gray-900">{{ Auth::user()->name }}</h4>
                @if(Auth::user()->company_name)
                    <p class="text-sm text-gray-600">{{ Auth::user()->company_name }}</p>
                @endif
                <p class="text-sm text-gray-600">{{ Auth::user()->address ?? 'Adres girilmemiş' }}</p>
                <p class="text-sm text-gray-600">{{ Auth::user()->city }} / {{ Auth::user()->country }}</p>
                <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Sipariş Durumu</p>
                @if($order->status == 'paid')
                    <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-green-100 text-green-800">ÖDENDİ</span>
                @else
                    <span class="px-4 py-2 inline-flex text-sm font-bold rounded-lg bg-yellow-100 text-yellow-800 text-uppercase">BEKLİYOR</span>
                @endif
            </div>
        </div>

        <div class="p-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase pb-4">Hizmet / Ürün Açıklaması</th>
                        <th class="text-center text-xs font-bold text-gray-500 uppercase pb-4">Periyot</th>
                        <th class="text-right text-xs font-bold text-gray-500 uppercase pb-4">Tutar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="py-4">
                                <p class="font-bold text-gray-900">{{ $item->item_name }}</p>
                                <p class="text-xs text-gray-500 uppercase">{{ $item->item_type }}</p>
                            </td>
                            <td class="py-4 text-center text-sm text-gray-600">
                                {{ $item->period }}
                            </td>
                            <td class="py-4 text-right font-medium text-gray-900">
                                {{ number_format($item->price, 2) }} ₺
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end">
            <div class="w-64">
                <div class="flex justify-between py-2 text-sm text-gray-600">
                    <span>Ara Toplam</span>
                    <span>{{ number_format($order->total_amount / 1.20, 2) }} ₺</span>
                </div>
                <div class="flex justify-between py-2 text-sm text-gray-600">
                    <span>KDV (%20)</span>
                    <span>{{ number_format($order->total_amount - ($order->total_amount / 1.20), 2) }} ₺</span>
                </div>
                <div class="flex justify-between py-4 mt-2 border-t border-gray-200">
                    <span class="font-bold text-gray-900 text-lg">Genel Toplam</span>
                    <span class="font-extrabold text-indigo-600 text-xl">{{ number_format($order->total_amount, 2) }} ₺</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection