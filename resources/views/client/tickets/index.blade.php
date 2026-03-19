@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Destek Taleplerim</h1>
            <p class="text-sm text-gray-500 mt-1">Teknik destek veya muhasebe departmanı ile olan tüm iletişimleriniz.</p>
        </div>
        <a href="{{ route('client.tickets.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-xl shadow-sm transition flex items-center">
            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Yeni Talep Oluştur
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-md font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if(count($tickets) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Durum</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Konu</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Öncelik</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Son İşlem</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Detay</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tickets as $ticket)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($ticket->status == 'open')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Açık / Bekliyor</span>
                                @elseif($ticket->status == 'answered')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Yanıtlandı</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Kapatıldı</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">{{ $ticket->subject }}</div>
                                <div class="text-xs text-gray-500">Talep No: #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($ticket->priority == 'high')
                                    <span class="text-red-600 font-bold text-sm">Yüksek</span>
                                @elseif($ticket->priority == 'medium')
                                    <span class="text-blue-600 font-bold text-sm">Orta</span>
                                @else
                                    <span class="text-gray-500 font-bold text-sm">Düşük</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->updated_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('client.tickets.show', $ticket->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold bg-indigo-50 px-3 py-2 rounded-lg">Görüntüle</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                <h3 class="text-lg font-medium text-gray-900">Henüz destek talebiniz yok</h3>
                <p class="mt-1 text-gray-500">Bir sorununuz olduğunda buradan bize ulaşabilirsiniz.</p>
            </div>
        @endif
    </div>
</div>
@endsection