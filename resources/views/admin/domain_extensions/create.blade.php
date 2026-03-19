@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Yeni Domain Uzantısı Ekle</h2>

    <form action="{{ route('admin.domain-extensions.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Uzantı (Örn: .com)</label>
                <input type="text" name="extension" placeholder=".com" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">API Sağlayıcı</label>
                <select name="provider_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" required>
                    <option value="">-- Sağlayıcı Seçin --</option>
                    @foreach($providers as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Sadece "Domain" türündeki sağlayıcılar listelenir.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kayıt Fiyatı ($)</label>
                <input type="number" step="0.01" name="register_price" value="0.00" class="w-full border-gray-300 rounded-lg shadow-sm p-2 border" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Yenileme Fiyatı ($)</label>
                <input type="number" step="0.01" name="renew_price" value="0.00" class="w-full border-gray-300 rounded-lg shadow-sm p-2 border" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Transfer Fiyatı ($)</label>
                <input type="number" step="0.01" name="transfer_price" value="0.00" class="w-full border-gray-300 rounded-lg shadow-sm p-2 border" required>
            </div>
        </div>

        <div class="space-y-3 mb-6 border-t pt-4">
            <h3 class="text-lg font-medium text-gray-900">Özel Ayarlar</h3>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_manual_override" id="is_manual_override" value="1" class="h-4 w-4 text-blue-600 rounded">
                <label for="is_manual_override" class="ml-2 block text-sm text-gray-900">Fiyatı Manuel Belirle (Otomatik kur/API senkronizasyonu bu uzantıyı etkilemez)</label>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="check_premium" id="check_premium" value="1" class="h-4 w-4 text-blue-600 rounded">
                <label for="check_premium" class="ml-2 block text-sm text-gray-900">Premium Domain Sorgusu Yapılsın</label>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="whois_privacy_default" id="whois_privacy_default" value="1" class="h-4 w-4 text-blue-600 rounded">
                <label for="whois_privacy_default" class="ml-2 block text-sm text-gray-900">WHOIS Gizliliği Varsayılan Olarak Açık/Ücretsiz Olsun</label>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked class="h-4 w-4 text-blue-600 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-900 font-bold">Bu Uzantı Satışa Açık</label>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">Kaydet</button>
        </div>
    </form>
</div>
@endsection