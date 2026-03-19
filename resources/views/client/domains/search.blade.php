@extends('layouts.client')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="bg-indigo-900 rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="p-8 md:p-12 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Harika Fikriniz İçin Mükemmel İsmi Bulun</h2>
            <p class="text-indigo-200 mb-8 text-lg">Milyonlarca alan adı arasından size en uygun olanı hemen tescil edin.</p>

            <form action="{{ route('client.domains.search') }}" method="GET" class="max-w-3xl mx-auto relative">
                <input type="text" name="domain" value="{{ $query ?? '' }}" placeholder="Örn: global-altyapi" required
                    class="w-full pl-6 pr-32 py-4 rounded-xl text-lg text-gray-900 focus:outline-none focus:ring-4 focus:ring-indigo-500 shadow-inner">
                <button type="submit" class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 rounded-lg transition cursor-pointer">
                    Sorgula
                </button>
            </form>
        </div>
    </div>

    @if(isset($results) && $results !== null)
    <h3 class="text-xl font-bold text-gray-800 mb-4">Arama Sonuçları: <span class="text-indigo-600">{{ $query }}</span></h3>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <ul class="divide-y divide-gray-100">
            @foreach($results as $result)
            <li class="p-4 sm:p-6 hover:bg-gray-50 transition flex flex-col sm:flex-row items-start sm:items-center justify-between">
                
                <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                    @if($result->is_available)
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    @else
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    @endif

                    <div>
                        <h4 class="text-lg font-bold text-gray-900">{{ $result->full_domain }}</h4>
                        <p class="text-sm {{ $result->is_available ? 'text-green-600 font-medium' : 'text-red-500' }}">
                            {{ $result->is_available ? 'Bu alan adı müsait!' : 'Maalesef alınmış.' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-6 w-full sm:w-auto justify-between sm:justify-end">
                    @if($result->is_available)
                        <div class="text-right">
                            <span class="block text-2xl font-black text-gray-900">${{ $result->price }}<span class="text-sm text-gray-500 font-normal">/yıl</span></span>
                        </div>
                        
                        <form action="{{ route('client.cart.add-domain') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <input type="hidden" name="full_domain" value="{{ $result->full_domain }}">
                            <input type="hidden" name="price" value="{{ $result->price }}">
                            <input type="hidden" name="ext_id" value="{{ $result->ext_id }}">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-medium transition flex items-center cursor-pointer">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Sepete Ekle
                            </button>
                        </form>
                    @else
                        <button type="button" class="bg-gray-200 text-gray-500 px-5 py-2.5 rounded-lg font-medium cursor-not-allowed" disabled>
                            Alınamaz
                        </button>
                    @endif
                </div>
                
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection