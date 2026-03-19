@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Webhook Gelen Kutusu (Logs)</h1>
        <p class="mt-1 text-sm text-gray-500">Ödeme sağlayıcılarından ve diğer API'lerden gelen tüm otomatik bildirimleri izleyin.</p>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Zaman</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Sağlayıcı</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Olay (Event)</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Sipariş No</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Durum</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($logs as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $log->created_at->format('d.m.Y H:i:s') }}</td>
                        <td class="px-6 py-4 font-bold uppercase text-gray-700">{{ $log->provider }}</td>
                        <td class="px-6 py-4 text-sm"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">{{ $log->event_type }}</span></td>
                        <td class="px-6 py-4 text-sm text-indigo-600 font-mono">{{ $log->order_number ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($log->status == 'processed')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">İşlendi</span>
                            @elseif($log->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Bekliyor</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold" title="{{ $log->error_message }}">Hata</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection