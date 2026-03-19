@extends('layouts.client')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex items-center">
        <a href="{{ route('client.tickets.index') }}" class="text-gray-400 hover:text-indigo-600 mr-4">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Yeni Destek Talebi</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('client.tickets.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Konu Özeti</label>
                <input type="text" name="subject" required placeholder="Örn: Siteme SSL sertifikası kuramıyorum" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Öncelik Durumu</label>
                <select name="priority" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="low">Düşük (Genel Sorular)</option>
                    <option value="medium" selected>Orta (Teknik Sorunlar)</option>
                    <option value="high">Yüksek (Sitem Çöktü / Acil)</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Mesajınız / Sorunun Detayı</label>
                <textarea name="message" rows="6" required placeholder="Lütfen yaşadığınız sorunu detaylıca anlatın..." class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-sm transition">
                    Talebi Gönder
                </button>
            </div>
        </form>
    </div>
</div>
@endsection