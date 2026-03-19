@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Güvenli Ödeme</h1>
        <p class="text-gray-500 mt-2">Siparişinizi tamamlamak için lütfen ödeme bilgilerinizi girin.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="h-6 w-6 text-indigo-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    Kredi/Banka Kartı Bilgileri
                </h2>

                <form action="{{ route('client.checkout.process') }}" method="POST" id="payment-form">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Kart Üzerindeki İsim</label>
                            <input type="text" name="card_name" required placeholder="Örn: Ahmet Yılmaz"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 border">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Kart Numarası</label>
                            <input type="text" name="card_number" required placeholder="0000 0000 0000 0000" maxlength="19"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 border font-mono tracking-widest">
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Son Kullanma Tarihi</label>
                                <input type="text" name="expiry" required placeholder="AA/YY" maxlength="5"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 border text-center">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">CVV</label>
                                <input type="text" name="cvv" required placeholder="123" maxlength="3"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 border text-center">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex justify-center items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"/></svg>
                            {{ number_format($total, 2) }} ₺ Güvenle Öde
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center">
                            <svg class="h-4 w-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                            256-bit SSL şifreleme ile güvendesiniz.
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-4">
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Sipariş Özeti</h3>
                
                <div class="space-y-4 mb-6">
                    @foreach($cart as $item)
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="font-bold text-gray-800">{{ $item['name'] }}</p>
                                <p class="text-gray-500">{{ $item['type'] == 'domain' ? 'Alan Adı' : 'Hosting' }} - {{ $item['period'] }}</p>
                            </div>
                            <span class="font-bold text-gray-900">{{ number_format($item['price'], 2) }} ₺</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Ara Toplam</span>
                        <span>{{ number_format($total, 2) }} ₺</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Vergiler (KDV Dahil)</span>
                        <span>0.00 ₺</span>
                    </div>
                    <div class="flex justify-between text-lg font-extrabold text-indigo-700 mt-2 pt-2 border-t border-gray-200">
                        <span>Genel Toplam</span>
                        <span>{{ number_format($total, 2) }} ₺</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection