@extends('layouts.auth')

@section('title', 'Giriş Yap')

@section('content')
<div class="bg-zinc-950 border border-zinc-800/50 rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-white mb-6 text-center tracking-tight">Hesabınıza Giriş Yapın</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-zinc-400 mb-1.5">E-Posta Adresi</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                   class="w-full bg-black border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 p-3 transition-all @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-sm font-medium text-zinc-400">Şifre</label>
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full bg-black border border-zinc-800 rounded-xl text-white placeholder-zinc-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 p-3 transition-all @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input class="h-4 w-4 bg-black border-zinc-800 text-blue-600 focus:ring-blue-500 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="ml-2 block text-sm text-zinc-400" for="remember">Beni Hatırla</label>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3.5 px-4 rounded-xl transition-all duration-200 shadow-sm active:scale-[0.98]">
            Giriş Yap
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-zinc-400">
        Hesabınız yok mu? <a href="{{ route('register') }}" class="text-white hover:text-blue-400 font-medium transition-colors">Hemen Kayıt Olun</a>
    </div>
</div>
@endsection