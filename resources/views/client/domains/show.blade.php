@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <nav class="flex text-sm text-gray-500 mb-2">
                <a href="{{ route('client.domains.index') }}" class="hover:text-indigo-600">Domainlerim</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">{{ $domain->domain_name }}</span>
            </nav>
            <h2 class="text-3xl font-bold text-gray-900">{{ $domain->domain_name }}</h2>
        </div>
        <div>
            <span class="px-4 py-1.5 bg-green-100 text-green-800 rounded-full text-sm font-bold uppercase">
                {{ $domain->status }}
            </span>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-medium rounded shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Domain Detayları</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">Kayıt Tarihi</p>
                        <p class="text-gray-700 font-medium">{{ $domain->registered_at ? $domain->registered_at->format('d.m.Y') : 'Bekliyor' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold">Bitiş Tarihi</p>
                        <p class="text-gray-700 font-medium">{{ $domain->expires_at ? $domain->expires_at->format('d.m.Y') : 'Bekliyor' }}</p>
                    </div>
                    <div class="pt-4 border-t">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Otomatik Yenileme</span>

                            <form action="{{ route('client.domains.toggle-auto-renew', $domain->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs font-bold px-3 py-1 rounded-full transition-colors duration-200 {{ $domain->auto_renew ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                    {{ $domain->auto_renew ? 'AÇIK (Kapat)' : 'KAPALI (Aç)' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 rounded-r-lg">
                <div class="flex">
                    <svg class="h-5 w-5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"></path>
                    </svg>
                    <p class="ml-3 text-xs text-indigo-700 font-medium">Domain güvenliği için transfer kilidi şu an aktif durumdadır.</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Nameserver (NS) Yönetimi</h3>
                    <p class="text-sm text-gray-500">Domaininizi bir sunucuya yönlendirmek için aşağıdaki adresleri güncelleyin.</p>
                </div>

                <form action="{{ route('client.domains.update', $domain->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-600 uppercase">Nameserver 1</label>
                            <input type="text" name="ns1" value="{{ $domain->nameservers['ns1'] ?? 'ns1.global-altyapi.com' }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-600 uppercase">Nameserver 2</label>
                            <input type="text" name="ns2" value="{{ $domain->nameservers['ns2'] ?? 'ns2.global-altyapi.com' }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                            Değişiklikleri Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection