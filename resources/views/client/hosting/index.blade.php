@extends('layouts.client')

@section('content')
<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-16">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">Güçlü ve Hızlı Web Hosting</h1>
        <p class="mt-4 text-xl text-gray-500">Projeniz için en uygun paketi seçin. NVMe SSD diskler ve Litespeed teknolojisi ile ışık hızında performans.</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-md max-w-3xl mx-auto text-center font-medium">
            {{ session('success') }}
            <a href="{{ route('client.cart.index') }}" class="ml-2 underline font-bold">Sepete Git &rarr;</a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
        @foreach($packages as $package)
            <div class="relative bg-white border {{ $package->is_recommended ? 'border-indigo-500 shadow-2xl scale-105 z-10' : 'border-gray-200 shadow-sm' }} rounded-2xl flex flex-col p-8 transition-transform hover:scale-105 duration-300">
                
                @if($package->is_recommended)
                    <div class="absolute top-0 inset-x-0 flex justify-center -mt-4">
                        <span class="bg-indigo-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">En Popüler</span>
                    </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $package->name }}</h3>
                    <p class="mt-2 text-sm text-gray-500">{{ $package->description }}</p>
                </div>

                <div class="mb-6 flex items-baseline text-gray-900">
                    <span class="text-5xl font-extrabold tracking-tight">{{ number_format($package->price, 2) }}</span>
                    <span class="text-xl font-semibold">₺</span>
                    <span class="ml-1 text-xl font-medium text-gray-500">/ {{ $package->billing_cycle }}</span>
                </div>

                <ul role="list" class="mb-8 space-y-4 flex-1">
                    @if(is_array($package->features))
                        @foreach($package->features as $feature)
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <p class="ml-3 text-base text-gray-700">{{ $feature }}</p>
                            </li>
                        @endforeach
                    @endif
                </ul>

                <form action="{{ route('client.cart.add-hosting') }}" method="POST" class="mt-auto">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <input type="hidden" name="name" value="{{ $package->name }} Hosting Paketi">
                    <input type="hidden" name="price" value="{{ $package->price }}">
                    <input type="hidden" name="period" value="{{ $package->billing_cycle }}">
                    
                    <button type="submit" class="w-full flex justify-center items-center py-3 px-4 rounded-xl shadow-sm text-base font-bold text-white {{ $package->is_recommended ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-800 hover:bg-gray-900' }} transition-colors">
                        Sepete Ekle
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection