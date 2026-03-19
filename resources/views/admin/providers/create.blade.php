@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Yeni Sağlayıcı (Provider) Ekle</h1>
            <p class="mt-1 text-sm text-gray-500">Sisteme yeni bir API entegrasyonu tanımlayın.</p>
        </div>
        <a href="{{ route('admin.providers.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
            &larr; Geri Dön
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
            <ul class="list-disc list-inside text-red-700 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
        <form action="{{ route('admin.providers.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2 border-b pb-4">
                    <h3 class="text-lg font-medium text-gray-900">1. Temel Bilgiler</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sağlayıcı Adı</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Örn: Namecheap API"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hizmet Türü</label>
                    <select name="service_type" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                        <option value="">Seçiniz...</option>
                        <option value="domain" {{ old('service_type') == 'domain' ? 'selected' : '' }}>Domain</option>
                        <option value="hosting" {{ old('service_type') == 'hosting' ? 'selected' : '' }}>Hosting / Sunucu</option>
                        <option value="payment" {{ old('service_type') == 'payment' ? 'selected' : '' }}>Ödeme (Payment)</option>
                        <option value="ssl" {{ old('service_type') == 'ssl' ? 'selected' : '' }}>SSL Sertifikası</option>
                        <option value="sms" {{ old('service_type') == 'sms' ? 'selected' : '' }}>SMS / SMTP</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bölge (Region)</label>
                    <input type="text" name="region" value="{{ old('region') }}" placeholder="Örn: Global, TR, EU"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                </div>

                <div class="sm:col-span-2 border-b pb-4 mt-4">
                    <h3 class="text-lg font-medium text-gray-900">2. API Bağlantı Ayarları</h3>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Endpoint URL</label>
                    <input type="url" name="endpoint_url" value="{{ old('endpoint_url') }}" placeholder="https://api.provider.com/v1"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
                    <input type="text" name="api_key" value="{{ old('api_key') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Secret Key / Password</label>
                    <input type="password" name="secret_key"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                </div>

                <div class="sm:col-span-2 border-b pb-4 mt-4">
                    <h3 class="text-lg font-medium text-gray-900">3. Orkestrasyon ve Yedeklilik</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Öncelik Sırası (1 en yüksek)</label>
                    <input type="number" name="priority" value="{{ old('priority', 1) }}" min="1" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Yedek (Fallback) Sağlayıcı</label>
                    <select name="fallback_provider_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border">
                        <option value="">Yok (Sadece bu sağlayıcıyı kullan)</option>
                        @foreach($activeProviders as $p)
                            <option value="{{ $p->id }}" {{ old('fallback_provider_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ strtoupper($p->service_type) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-2 mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 h-5 w-5">
                        <span class="ml-2 text-sm text-gray-700 font-bold">Sağlayıcıyı Aktif Et</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-colors">
                    Sağlayıcıyı Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection