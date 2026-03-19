@extends('layouts.client')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Hesap Ayarları</h1>
        <p class="mt-1 text-sm text-gray-500">Kişisel bilgilerinizi ve fatura detaylarınızı buradan güncelleyebilirsiniz.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-md shadow-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-200">
        <form action="{{ route('client.profile.update') }}" method="POST">
            @csrf
            
            <div class="p-8 border-b border-gray-100">
                <h3 class="text-lg leading-6 font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Kişisel Bilgiler
                </h3>
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-bold text-gray-700">Ad Soyad</label>
                        <input type="text" name="name" value="{{ $user->name }}" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-bold text-gray-700">E-posta Adresi <span class="text-xs text-gray-400 font-normal">(Değiştirilemez)</span></label>
                        <input type="email" value="{{ $user->email }}" disabled class="mt-1 block w-full border border-gray-200 bg-gray-50 rounded-lg shadow-sm py-2 px-3 text-gray-500 sm:text-sm">
                    </div>
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-bold text-gray-700">Telefon Numarası</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" placeholder="05XX XXX XX XX" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
            </div>

            <div class="p-8 bg-gray-50">
                <h3 class="text-lg leading-6 font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Fatura Bilgileri
                </h3>
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-gray-700">Firma Adı (Opsiyonel)</label>
                        <input type="text" name="company_name" value="{{ $user->company_name }}" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-bold text-gray-700">Vergi Dairesi</label>
                        <input type="text" name="tax_office" value="{{ $user->tax_office }}" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-bold text-gray-700">Vergi / TC Kimlik No</label>
                        <input type="text" name="tax_number" value="{{ $user->tax_number }}" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-gray-700">Açık Adres</label>
                        <textarea name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $user->address }}</textarea>
                    </div>
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-bold text-gray-700">Şehir</label>
                        <input type="text" name="city" value="{{ $user->city }}" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-bold text-gray-700">Ülke</label>
                        <input type="text" name="country" value="{{ $user->country ?? 'Türkiye' }}" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
            </div>

            <div class="px-8 py-5 bg-gray-100 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-xl shadow-sm transition flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Ayarları Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection