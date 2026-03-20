<div>
    <div class="bg-indigo-900 rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="p-8 md:p-12 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Harika Fikriniz İçin Mükemmel İsmi Bulun</h2>
            <p class="text-indigo-200 mb-8 text-lg">Milyonlarca alan adı arasından size en uygun olanı hemen tescil edin.</p>

            <form wire:submit.prevent="search" class="max-w-3xl mx-auto relative">
                <input type="text" wire:model="query" placeholder="Örn: global-altyapi" required
                    class="w-full pl-6 pr-32 py-4 rounded-xl text-lg text-gray-900 focus:outline-none focus:ring-4 focus:ring-indigo-500 shadow-inner disabled:opacity-50"
                    wire:loading.attr="disabled" wire:target="search">
                <button type="submit" wire:loading.attr="disabled" wire:target="search" class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 rounded-lg transition cursor-pointer disabled:opacity-75 flex items-center">
                    <span wire:loading.remove wire:target="search">Sorgula</span>
                    <span wire:loading wire:target="search" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Aranıyor...
                    </span>
                </button>
            </form>
        </div>
    </div>

    <!-- Skeleton Loader (Kullanıcı ararken gösterilir) -->
    <div wire:loading wire:target="search" class="w-full">
        <h3 class="text-xl font-bold text-gray-800 mb-4 animate-pulse bg-gray-200 h-6 w-1/3 rounded"></h3>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <ul class="divide-y divide-gray-100">
                @for($i = 0; $i < 4; $i++)
                <li class="p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <div class="w-10 h-10 rounded-full bg-gray-200 animate-pulse"></div>
                        <div>
                            <div class="h-5 bg-gray-200 rounded w-48 mb-2 animate-pulse"></div>
                            <div class="h-4 bg-gray-100 rounded w-32 animate-pulse"></div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6 w-full sm:w-auto justify-between sm:justify-end">
                        <div class="h-8 bg-gray-200 rounded w-24 animate-pulse"></div>
                        <div class="h-10 bg-gray-200 rounded w-32 animate-pulse"></div>
                    </div>
                </li>
                @endfor
            </ul>
        </div>
    </div>

    <!-- Gerçek Sonuçlar -->
    <div wire:loading.remove wire:target="search">
        @if($results !== null)
        <h3 class="text-xl font-bold text-gray-800 mb-4">Arama Sonuçları: <span class="text-indigo-600">{{ $query }}</span></h3>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
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
        
        @if($aiSuggestions && count($aiSuggestions) > 0)
        <!-- AI Support Section -->
        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="h-6 w-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
            Yapay Zeka Destekli Premium Öneriler
        </h3>
        <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl shadow-sm border border-amber-200 overflow-hidden p-1">
            <ul class="divide-y divide-amber-100 bg-white/60 rounded-lg">
                @foreach($aiSuggestions as $result)
                <li class="p-4 sm:p-6 hover:bg-amber-100/50 transition flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">{{ $result->full_domain }}</h4>
                            <p class="text-sm text-yellow-600 font-medium">Bu premium alan adı sizin için özel türetildi!</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6 w-full sm:w-auto justify-between sm:justify-end">
                        <div class="text-right">
                            <span class="block text-2xl font-black text-gray-900">${{ $result->price }}<span class="text-sm text-gray-500 font-normal">/yıl</span></span>
                        </div>
                        <form action="{{ route('client.cart.add-domain') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <input type="hidden" name="full_domain" value="{{ $result->full_domain }}">
                            <input type="hidden" name="price" value="{{ $result->price }}">
                            <input type="hidden" name="ext_id" value="{{ $result->ext_id }}">
                            <button type="submit" class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 shadow-md text-white px-5 py-2.5 rounded-lg font-bold transition flex items-center cursor-pointer">
                                Sepete Ekle
                            </button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @elseif(strlen($query) > 0 && strlen($query) < 3)
            <div class="bg-yellow-50 text-yellow-800 p-4 rounded-xl mt-4">Lütfen en az 3 karakter girin.</div>
        @endif
    </div>
</div>
