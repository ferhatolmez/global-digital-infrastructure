@extends('layouts.auth')

@section('content')
<div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Yeni Hesap Oluşturun</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-Posta Adresi</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Şifre (Tekrar)</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
            Kayıt Ol
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
        Zaten hesabınız var mı? <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Giriş Yapın</a>
    </div>
</div>
@endsection