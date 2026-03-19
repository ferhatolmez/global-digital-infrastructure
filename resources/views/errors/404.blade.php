@extends('layouts.client')

@section('content')
<div class="h-[80vh] flex flex-col items-center justify-center text-center px-4">
    <h1 class="text-9xl font-extrabold text-indigo-600 tracking-widest">404</h1>
    <div class="bg-white px-2 text-sm rounded rotate-12 absolute border border-indigo-600">
        Sayfa Bulunamadı
    </div>
    <p class="text-gray-500 mt-5 text-lg">Aradığınız yol dijital boşlukta kaybolmuş olabilir.</p>
    <a href="{{ route('client.dashboard') }}" class="mt-8 bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">
        Güvenli Bölgeye Dön (Dashboard)
    </a>
</div>
@endsection