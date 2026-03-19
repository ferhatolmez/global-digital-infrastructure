@extends('layouts.client')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center">
        <a href="{{ route('client.services.index') }}" class="mr-4 text-gray-400 hover:text-indigo-600"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Hizmet Detayları: {{ $service->domain }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <h3 class="font-bold text-gray-900 mb-6 flex items-center">
                <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Teknik Bilgiler
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">IP Adresi:</span>
                    <span class="text-sm font-bold text-gray-900">185.122.54.12</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">FTP Kullanıcı:</span>
                    <span class="text-sm font-bold text-gray-900">u{{ Auth::id() }}_{{ $service->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">Disk Alanı:</span>
                    <span class="text-sm font-bold text-gray-900">10 GB / 2.4 GB Kullanımda</span>
                </div>
            </div>
            <div class="mt-8">
                <a href="{{ route('client.builder.index') }}" class="block w-full text-center bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition">Sihirbazı Başlat</a>
            </div>
        </div>

        <div class="bg-gray-50 rounded-2xl border border-gray-200 p-8">
            <h3 class="font-bold text-gray-900 mb-6">Yönetim Araçları</h3>
            <div class="grid grid-cols-2 gap-4">
                <button class="bg-white border border-gray-200 p-4 rounded-xl hover:border-indigo-500 transition text-center group">
                    <svg class="h-6 w-6 mx-auto mb-2 text-gray-400 group-hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    <span class="text-xs font-bold text-gray-600">Şifre Değiştir</span>
                </button>
                <button class="bg-white border border-gray-200 p-4 rounded-xl hover:border-indigo-500 transition text-center group">
                    <svg class="h-6 w-6 mx-auto mb-2 text-gray-400 group-hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-xs font-bold text-gray-600">Yedek Al</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection