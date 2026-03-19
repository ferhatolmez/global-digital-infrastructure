@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Entegrasyon Yönetim Merkezi</h1>
            <p class="mt-2 text-sm text-gray-700">Tüm harici API sağlayıcılarını (Domain, Hosting, Ödeme) buradan yönetebilir, önceliklendirebilir ve test edebilirsiniz.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.providers.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 sm:w-auto">
                + Yeni Sağlayıcı Ekle
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sağlayıcı Adı</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hizmet Türü</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Öncelik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Yedek (Fallback)</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($providers as $provider)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $provider->name }}</div>
                                <div class="text-xs text-gray-500">{{ $provider->region ?? 'Global' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 uppercase">
                                    {{ $provider->service_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                                {{ $provider->priority }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $provider->fallbackProvider ? $provider->fallbackProvider->name : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($provider->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Pasif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <form action="{{ route('admin.providers.test', $provider->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-2 py-1 rounded">Test Et</button>
                                </form>
                                <a href="{{ route('admin.providers.edit', $provider->id) }}" class="text-yellow-600 hover:text-yellow-900 bg-yellow-50 px-2 py-1 rounded">Düzenle</a>
                                <form action="{{ route('admin.providers.destroy', $provider->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bu sağlayıcıyı silmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-2 py-1 rounded">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Henüz hiçbir API sağlayıcısı eklenmemiş.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($providers->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $providers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection