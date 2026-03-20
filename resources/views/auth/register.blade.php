@extends('layouts.auth')

@section('title', 'Kayıt Ol')

@section('content')
<div class="bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Yeni Hesap Oluşturun</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1.5">Ad Soyad</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                   class="w-full bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 p-3 transition-all @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">E-Posta Adresi</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                   class="w-full bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 p-3 transition-all @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Şifre</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 p-3 transition-all @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password-confirm" class="block text-sm font-medium text-gray-300 mb-1.5">Şifre (Tekrar)</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 p-3 transition-all">
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-200 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.02] active:scale-[0.98]">
            Kayıt Ol
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-400">
        Zaten hesabınız var mı? <a href="{{ route('login') }}" class="text-indigo-400 font-bold hover:text-indigo-300 transition-colors">Giriş Yapın</a>
    </div>
</div>
@endsection