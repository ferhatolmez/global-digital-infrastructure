@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Müşteriler</h1>
    <p class="text-sm text-slate-500 mt-1">Sistemdeki tüm kayıtlı müşteriler ve özet bilgileri.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Müşteri Adı</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">İletişim</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-500 uppercase">Kayıt Tarihi</th>
                <th class="px-6 py-3 text-center text-xs font-bold text-slate-500 uppercase">Sipariş Sayısı</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @foreach($users as $user)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="font-bold text-slate-800">{{ $user->name }}</div>
                                <div class="text-xs text-slate-500">{{ $user->company_name ?? 'Bireysel' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-900">{{ $user->email }}</div>
                        <div class="text-xs text-slate-500">{{ $user->phone ?? 'Telefon Yok' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        {{ $user->created_at->format('d.m.Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-slate-100 text-slate-800">
                            {{ $user->orders_count }} Sipariş
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection