@extends('layouts.auth')

@section('title', 'Kayıt Ol')

@section('content')
<div class="bg-zinc-950 border border-zinc-800/50 rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-white mb-6 text-center tracking-tight">Yeni Hesap Oluşturun</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-zinc-400 mb-1.5">Ad Soyad</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                   class="w-full bg-black border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 p-3 transition-all @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-zinc-400 mb-1.5">E-Posta Adresi</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                   class="w-full bg-black border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 p-3 transition-all @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-zinc-400 mb-1.5">Şifre</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full bg-black border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 p-3 transition-all @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password-confirm" class="block text-sm font-medium text-zinc-400 mb-1.5">Şifre (Tekrar)</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full bg-black border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 p-3 transition-all">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3.5 px-4 rounded-xl transition-all duration-200 shadow-sm active:scale-[0.98]">
            Kayıt Ol
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-zinc-400">
        Zaten hesabınız var mı? <a href="{{ route('login') }}" class="text-white hover:text-blue-400 font-medium transition-colors">Giriş Yapın</a>
    </div>
</div>
@endsection