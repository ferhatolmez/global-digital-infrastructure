@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Destek Talepleri (Tickets)</h1>
    <p class="text-sm text-slate-500 mt-1">Müşterilerden gelen tüm talepleri buradan yönetebilirsiniz.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-md font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Müşteri</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Konu</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Öncelik</th>
                <th class="px-6 py-3 text-right text-xs font-bold text-slate-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @foreach($tickets as $ticket)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($ticket->status == 'open')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-800 animate-pulse">Yeni Mesaj</span>
                        @elseif($ticket->status == 'answered')
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800">Yanıtlandı</span>
                        @else
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-slate-100 text-slate-600">Kapatıldı</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-bold text-slate-800">{{ $ticket->user->name }}</div>
                        <div class="text-xs text-slate-500">{{ $ticket->user->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $ticket->subject }}</div>
                        <div class="text-xs text-slate-500">Talep No: #{{ $ticket->id }} | {{ $ticket->created_at->diffForHumans() }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($ticket->priority == 'high')
                            <span class="text-red-600 font-bold text-sm">Yüksek</span>
                        @elseif($ticket->priority == 'medium')
                            <span class="text-blue-600 font-bold text-sm">Orta</span>
                        @else
                            <span class="text-slate-500 font-bold text-sm">Düşük</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-emerald-600 hover:text-emerald-900 font-bold bg-emerald-50 px-4 py-2 rounded-lg transition">Yönet &rarr;</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection