@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Sistem Sağlık ve Log Merkezi</h2>
    <p class="text-gray-500 text-sm mt-1">API durumları, kuyruk metrikleri ve gelen webhook logları.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <h3 class="text-sm font-medium text-gray-500 mb-1">Kuyruk (Queue) Backlog</h3>
        <div class="flex items-end space-x-2">
            <span class="text-3xl font-bold text-gray-800">{{ $queueBacklog }}</span>
            <span class="text-sm text-gray-500 mb-1">bekleyen işlem</span>
        </div>
        <p class="text-xs text-green-600 mt-2">Provisioning motoru aktif.</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 {{ $failedJobs > 0 ? 'border-red-500' : 'border-green-500' }}">
        <h3 class="text-sm font-medium text-gray-500 mb-1">Hatalı İşlemler (Failed Jobs)</h3>
        <div class="flex items-end space-x-2">
            <span class="text-3xl font-bold {{ $failedJobs > 0 ? 'text-red-600' : 'text-gray-800' }}">{{ $failedJobs }}</span>
            <span class="text-sm text-gray-500 mb-1">başarısız</span>
        </div>
        <p class="text-xs {{ $failedJobs > 0 ? 'text-red-500' : 'text-green-600' }} mt-2">
            {{ $failedJobs > 0 ? 'Müdahale gerekiyor!' : 'Tüm işlemler pürüzsüz.' }}
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 lg:col-span-2 border-l-4 border-indigo-500">
        <h3 class="text-sm font-medium text-gray-500 mb-3">Aktif API Sağlayıcıları</h3>
        <div class="flex space-x-4 overflow-x-auto pb-2">
            @forelse($activeProviders as $provider)
                <div class="flex items-center space-x-2 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                    <div class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-700">{{ $provider->name }}</span>
                    <span class="text-xs text-gray-400">({{ $provider->service_type }})</span>
                </div>
            @empty
                <span class="text-sm text-gray-500">Henüz aktif sağlayıcı yok.</span>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
        <h3 class="text-lg font-bold text-gray-800">Son Webhook Logları</h3>
        <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">CSV İndir</button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tarih</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Sağlayıcı</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Event (Olay)</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Hata Mesajı</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($webhookLogs as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $log->created_at->format('d.m.Y H:i:s') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 capitalize">
                        {{ $log->provider }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 bg-gray-50 rounded">
                        <code>{{ $log->event_type }}</code>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($log->status === 'success')
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">Başarılı</span>
                        @elseif($log->status === 'pending')
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">Bekliyor</span>
                        @else
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800">Hata</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-red-500 truncate max-w-xs">
                        {{ $log->error_message ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Henüz hiç webhook kaydı ulaşmadı.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-3 border-t border-gray-200">
        {{ $webhookLogs->links() }}
    </div>
</div>
@endsection