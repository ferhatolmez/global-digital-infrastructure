@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Aktif Hizmetlerim</h1>
        <p class="mt-1 text-sm text-gray-500">Sahip olduğunuz tüm hosting ve web sitesi hizmetlerinin listesi.</p>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($services as $service)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col md:flex-row items-center justify-between hover:shadow-md transition">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="bg-indigo-100 p-4 rounded-xl mr-5">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $service->domain ?? 'Henüz Alan Adı Yok' }}</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">{{ $service->package_name ?? 'Standart Paket' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-8 text-center md:text-left">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Durum</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Bitiş Tarihi</p>
                        <p class="text-sm font-bold text-gray-700">{{ $service->created_at->addYear()->format('d.m.Y') }}</p>
                    </div>
                </div>

                <div class="mt-4 md:mt-0">
                    <a href="{{ route('client.services.show', $service->id) }}" class="bg-gray-900 text-white font-bold py-2 px-6 rounded-xl hover:bg-gray-800 transition">Yönet</a>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl border-2 border-dashed border-gray-200 p-12 text-center">
                <p class="text-gray-400 italic">Henüz aktif bir hizmetiniz bulunmuyor.</p>
                <a href="{{ route('client.hosting.index') }}" class="inline-block mt-4 text-indigo-600 font-bold hover:underline">Hemen bir paket satın alın &rarr;</a>
            </div>
        @endforelse
    </div>
</div>
@endsection