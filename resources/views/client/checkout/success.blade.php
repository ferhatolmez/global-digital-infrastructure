@extends('layouts.client')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden text-center p-10">
        
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
            <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Siparişiniz Başarıyla Alındı!</h1>
        <p class="text-gray-500 text-lg mb-8">Teşekkür ederiz. Dijital altyapı hizmetleriniz şu anda hazırlanıyor.</p>

        <div class="bg-gray-50 rounded-xl p-6 text-left border border-gray-200 mb-8">
            <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-3 mb-4">Sipariş Detayları</h3>
            
            <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                <div>
                    <span class="block text-gray-500">Sipariş Numarası:</span>
                    <span class="font-bold text-indigo-700">{{ $order->order_number }}</span>
                </div>
                <div>
                    <span class="block text-gray-500">Tarih:</span>
                    <span class="font-bold text-gray-800">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div>
                    <span class="block text-gray-500">Ödeme Yöntemi:</span>
                    <span class="font-bold text-gray-800">Kredi Kartı</span>
                </div>
                <div>
                    <span class="block text-gray-500">Ödenen Tutar:</span>
                    <span class="font-bold text-gray-900">{{ number_format($order->total_amount, 2) }} ₺</span>
                </div>
            </div>

            <h4 class="font-bold text-gray-700 mb-3">Satın Alınan Hizmetler:</h4>
            <ul class="space-y-2">
                @foreach($order->items as $item)
                    <li class="flex justify-between text-sm py-2 border-b border-gray-100 last:border-0">
                        <div>
                            <span class="font-bold text-gray-800">{{ $item->name }}</span>
                            <span class="text-gray-500 ml-1">({{ $item->item_type == 'domain' ? 'Alan Adı' : 'Hosting' }})</span>
                        </div>
                        <span class="font-medium">{{ number_format($item->price, 2) }} ₺</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('client.domains.index') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">
                Hizmetlerime Git
            </a>
            <a href="#" class="bg-white border-2 border-gray-200 text-gray-700 px-8 py-3 rounded-xl font-bold hover:bg-gray-50 transition">
                Faturayı İndir (PDF)
            </a>
        </div>

    </div>
</div>
@endsection