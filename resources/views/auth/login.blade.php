@extends('layouts.auth')

@section('title', 'Giriş Yap')

@section('content')
<div class="bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Hesabınıza Giriş Yapın</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">E-Posta Adresi</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                   class="w-full bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 p-3 transition-all @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-sm font-medium text-gray-300">Şifre</label>
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 p-3 transition-all @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input class="h-4 w-4 bg-white/5 border-white/20 text-indigo-600 focus:ring-indigo-500 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="ml-2 block text-sm text-gray-300" for="remember">Beni Hatırla</label>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-200 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.02] active:scale-[0.98]">
            Giriş Yap
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-400">
        Hesabınız yok mu? <a href="{{ route('register') }}" class="text-indigo-400 font-bold hover:text-indigo-300 transition-colors">Hemen Kayıt Olun</a>
    </div>
</div>
@endsection