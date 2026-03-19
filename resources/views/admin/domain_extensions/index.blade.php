@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Domain Uzantı ve Fiyat Yönetimi</h2>
    <a href="{{ route('admin.domain-extensions.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
        + Yeni Uzantı Ekle
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uzantı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sağlayıcı API</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kayıt / Yenileme / Transfer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ayarlar</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($extensions as $ext)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap font-bold text-lg text-gray-900">
                    {{ $ext->extension }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $ext->provider->name ?? 'Tanımsız' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                    K: ${{ $ext->register_price }} <br>
                    Y: ${{ $ext->renew_price }} <br>
                    T: ${{ $ext->transfer_price }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 space-y-1">
                    <div>Otomatik Fiyat: {!! $ext->is_manual_override ? '<span class="text-red-500">Kapalı</span>' : '<span class="text-green-500">Açık</span>' !!}</div>
                    <div>WHOIS: {{ $ext->whois_privacy_default ? 'Ücretsiz' : 'Ücretli' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Düzenle</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Henüz domain uzantısı eklenmemiş.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection