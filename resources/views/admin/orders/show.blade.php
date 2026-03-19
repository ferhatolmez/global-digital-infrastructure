@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div class="flex items-center">
        <a href="{{ route('admin.orders.index') }}" class="text-slate-400 hover:text-emerald-600 mr-4">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Sipariş: {{ $order->order_number }}</h1>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-md font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Sipariş Kalemleri</h3>
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="text-left text-xs font-bold text-slate-500 uppercase pb-4">Ürün / Hizmet</th>
                    <th class="text-center text-xs font-bold text-slate-500 uppercase pb-4">Periyot</th>
                    <th class="text-right text-xs font-bold text-slate-500 uppercase pb-4">Fiyat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($order->items as $item)
                    <tr>
                        <td class="py-4">
                            <div class="font-bold text-slate-900">{{ $item->item_name }}</div>
                            <div class="text-xs text-slate-500 uppercase">{{ $item->item_type }}</div>
                        </td>
                        <td class="py-4 text-center text-sm text-slate-600">{{ $item->period }}</td>
                        <td class="py-4 text-right font-bold text-slate-900">{{ number_format($item->price, 2) }} ₺</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6 flex justify-end text-xl font-extrabold text-emerald-600">
            Toplam: {{ number_format($order->total_amount, 2) }} ₺
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 h-fit">
        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Müşteri & Durum</h3>
        
        <div class="mb-6">
            <p class="text-xs text-slate-500 uppercase font-bold">Müşteri</p>
            <p class="font-bold text-slate-800">{{ $order->user->name }}</p>
            <p class="text-sm text-slate-600">{{ $order->user->email }}</p>
        </div>

        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Sipariş Durumunu Değiştir</label>
                <select name="status" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Bekliyor (Ödenmedi)</option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Ödendi (Kurulum Bekliyor)</option>
                    <option value="active" {{ $order->status == 'active' ? 'selected' : '' }}>Aktif (Kuruldu/Yayında)</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>İptal Edildi</option>
                    <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Hata / Başarısız</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg transition">
                Durumu Güncelle
            </button>
        </form>
    </div>
</div>
@endsection