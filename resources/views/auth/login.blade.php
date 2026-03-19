@extends('layouts.auth')

@section('content')
<div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Hesabınıza Giriş Yapın</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-Posta Adresi</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Şifre</label>
                <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800">Şifremi Unuttum?</a>
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="ml-2 block text-sm text-gray-900" for="remember">Beni Hatırla</label>
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
            Giriş Yap
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
        Hesabınız yok mu? <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Hemen Kayıt Olun</a>
    </div>
</div>
@endsection