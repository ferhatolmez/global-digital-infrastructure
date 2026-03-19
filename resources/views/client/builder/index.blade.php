@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Site Sihirbazı (Builder)</h1>
            <p class="text-gray-500 mt-2">Sürükle-bırak yöntemiyle web sitenizi kod bilmeden tasarlayın.</p>
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

    @if(count($sites) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($sites as $site)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition flex flex-col">
            <div class="h-32 bg-indigo-50 flex items-center justify-center border-b border-gray-100 relative">
                <svg class="h-12 w-12 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                @if($site->is_published)
                <span class="absolute top-4 right-4 bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full">Yayında</span>
                @else
                <span class="absolute top-4 right-4 bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full">Taslak</span>
                @endif
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $site->domain_name }}</h3>
                <p class="text-xs text-gray-500 mb-4">Son Düzenleme: {{ $site->updated_at->diffForHumans() }}</p>

                <div class="mt-auto pt-4 space-y-2">
                    <a href="{{ route('client.builder.editor', $site->id) }}" class="w-full flex justify-center items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-xl transition">
                        <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Editörü Aç
                    </a>
                    <button class="w-full text-sm font-bold text-gray-600 hover:text-indigo-600 bg-gray-50 hover:bg-indigo-50 py-2 rounded-xl transition">
                        Canlı Önizleme
                    </button>

                    <form action="{{ route('client.builder.publish', $site->id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-sm font-bold text-green-700 hover:text-white bg-green-50 hover:bg-green-600 py-2 rounded-xl transition flex justify-center items-center">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Sunucuya Gönder (Yayına Al)
                        </button>
                    </form>
                </div>


            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-white border border-gray-200 rounded-xl">
        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
        </svg>
        <h3 class="text-lg font-medium text-gray-900">Henüz bir siteniz yok</h3>
        <p class="mt-1 text-gray-500">Site kurabilmek için önce bir domain satın almalısınız.</p>
    </div>
    @endif
</div>
@endsection