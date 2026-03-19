@extends('layouts.client')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Alışveriş Sepetim</h1>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                @php $total = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $total += $details['price']; @endphp
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center transition hover:shadow-md">
                        <div class="flex items-center">
                            <div class="p-3 bg-indigo-50 rounded-xl mr-4 text-indigo-600">
                                @if($details['type'] == 'hosting')
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2" /></svg>
                                @else
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" /></svg>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $details['name'] }}</h3>
                                <p class="text-xs text-gray-500 uppercase">{{ $details['type'] }} | {{ $details['period'] }}</p>
                            </div>
                        </div>
                        <div class="text-right flex items-center space-x-6">
                            <span class="font-extrabold text-gray-900 text-lg">{{ number_format($details['price'], 2) }} ₺</span>
                            <a href="{{ route('client.cart.remove', $id) }}" class="text-red-400 hover:text-red-600 p-2 bg-red-50 rounded-lg transition">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 h-fit sticky top-10">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Sipariş Özeti</h3>
                <div class="space-y-4 mb-6 border-b pb-6 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>Ara Toplam</span>
                        <span>{{ number_format($total / 1.2, 2) }} ₺</span>
                    </div>
                    <div class="flex justify-between">
                        <span>KDV (%20)</span>
                        <span>{{ number_format($total - ($total / 1.2), 2) }} ₺</span>
                    </div>
                </div>
                <div class="flex justify-between mb-8">
                    <span class="text-lg font-bold text-gray-900">Genel Toplam</span>
                    <span class="text-2xl font-extrabold text-indigo-600">{{ number_format($total, 2) }} ₺</span>
                </div>
                
                <form action="{{ route('client.checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                        Ödemeye Geç &rarr;
                    </button>
                </form>
                <p class="text-[10px] text-gray-400 mt-4 text-center italic">Iyzico güvenli ödeme altyapısı ile korunmaktadır.</p>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-gray-300">
            <div class="mb-6 inline-block p-6 bg-gray-50 rounded-full">
                <svg class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Sepetiniz Boş</h2>
            <p class="text-gray-500 mt-2 mb-8">Görünüşe göre henüz bir seçim yapmadınız.</p>
            <a href="{{ route('client.hosting.index') }}" class="bg-indigo-600 text-white font-bold py-3 px-8 rounded-xl hover:bg-indigo-700 transition">Alışverişe Başla</a>
        </div>
    @endif
</div>
@endsection