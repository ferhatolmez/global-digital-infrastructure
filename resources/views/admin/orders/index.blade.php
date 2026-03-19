@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Sipariş Yönetimi</h1>
    <p class="text-sm text-slate-500 mt-1">Sistemdeki tüm siparişleri ve durumlarını buradan yönetin.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Sipariş No</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Müşteri</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Tutar</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-bold text-slate-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @foreach($orders as $order)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap font-bold text-emerald-600">
                        {{ $order->order_number }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-slate-800">{{ $order->user->name }}</div>
                        <div class="text-xs text-slate-500">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-800">
                        {{ number_format($order->total_amount, 2) }} ₺
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($order->status == 'paid') <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800">Ödendi</span>
                        @elseif($order->status == 'active') <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800">Aktif (Kuruldu)</span>
                        @elseif($order->status == 'pending') <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-800">Bekliyor</span>
                        @else <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">Hata / İptal</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-emerald-600 hover:text-emerald-900 font-bold bg-emerald-50 px-3 py-2 rounded-lg">Yönet</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection