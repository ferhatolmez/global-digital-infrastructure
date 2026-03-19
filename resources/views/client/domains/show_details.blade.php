@extends('layouts.client')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center">
        <a href="{{ route('client.domains.my_domains') }}" class="mr-4 text-gray-400 hover:text-indigo-600"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $domain->domain_name }} Yönetimi</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <h3 class="font-bold text-gray-900 mb-6">Nameserver (DNS) Ayarları</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Nameserver 1</label>
                        <input type="text" value="{{ $domain->ns1 }}" class="w-full mt-1 border rounded-xl px-4 py-2 bg-gray-50 text-gray-600 font-mono text-sm" readonly>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Nameserver 2</label>
                        <input type="text" value="{{ $domain->ns2 }}" class="w-full mt-1 border rounded-xl px-4 py-2 bg-gray-50 text-gray-600 font-mono text-sm" readonly>
                    </div>
                </div>
                <p class="mt-4 text-[10px] text-amber-600 font-medium">! DNS değişikliklerinin aktif olması 24-48 saat sürebilir.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <h3 class="font-bold text-gray-900 mb-2">Transfer Kilidi & EPP Kodu</h3>
                <p class="text-sm text-gray-500 mb-4">Domaininizi başka bir firmaya taşımak için transfer koduna ihtiyacınız vardır.</p>
                <button class="bg-gray-100 text-gray-800 font-bold py-2 px-6 rounded-lg hover:bg-gray-200 transition text-sm">EPP Kodunu E-postama Gönder</button>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-lg">
                <h3 class="font-bold mb-4 opacity-80 uppercase text-xs tracking-widest">Hızlı Özet</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span>Durum:</span>
                        <span class="font-bold">Aktif</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Otomatik Yenileme:</span>
                        <span class="font-bold">{{ $domain->auto_renew ? 'Açık' : 'Kapalı' }}</span>
                    </div>
                </div>
                <hr class="my-4 border-indigo-500">
                <button class="w-full bg-white text-indigo-600 font-bold py-2 rounded-xl text-sm">Süreyi Uzat</button>
            </div>
        </div>
    </div>
</div>
@endsection