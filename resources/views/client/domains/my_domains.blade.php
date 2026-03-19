@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Alan Adlarım</h1>
            <p class="mt-1 text-sm text-gray-500">Tüm aktif ve süresi dolmak üzere olan alan adlarınız.</p>
        </div>
        <a href="{{ route('client.domains.search') }}" class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-xl hover:bg-indigo-700 transition">Yeni Domain Al</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if(count($domains) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left">Alan Adı</th>
                        <th class="px-6 py-4 text-center">Tescil Tarihi</th>
                        <th class="px-6 py-4 text-center">Bitiş Tarihi</th>
                        <th class="px-6 py-4 text-center">Durum</th>
                        <th class="px-6 py-4 text-right">Yönet</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($domains as $domain)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900">{{ $domain->domain_name }}</span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($domain->registration_date)->format('d.m.Y') }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-bold {{ \Carbon\Carbon::parse($domain->expiry_date)->isPast() ? 'text-red-500' : 'text-gray-700' }}">
                                {{ \Carbon\Carbon::parse($domain->expiry_date)->format('d.m.Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-[10px] font-bold rounded-full {{ $domain->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ strtoupper($domain->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('client.domains.show_details', $domain->id) }}" class="text-indigo-600 font-bold hover:underline">Yönet &rarr;</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-12 text-center">
                <p class="text-gray-400 italic">Henüz bir alan adınız bulunmuyor.</p>
            </div>
        @endif
    </div>
</div>
@endsection