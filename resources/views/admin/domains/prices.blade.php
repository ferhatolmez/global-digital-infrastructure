@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Gelişmiş Domain Fiyat Yönetimi</h1>
    <p class="text-sm text-slate-500 mt-1">Kayıt, Yenileme ve Transfer fiyatlarını ayrı ayrı yönetin.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-md font-medium">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50 text-xs font-bold text-slate-500 uppercase">
            <tr>
                <th class="px-6 py-4 text-left">Uzantı & Sağlayıcı</th>
                <th class="px-4 py-4 text-center">Kayıt (₺)</th>
                <th class="px-4 py-4 text-center">Yenileme (₺)</th>
                <th class="px-4 py-4 text-center">Transfer (₺)</th>
                <th class="px-4 py-4 text-center">Manuel Mod</th>
                <th class="px-6 py-4 text-right">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @foreach($extensions as $ext)
            <form id="update-form-{{ $ext->id }}" action="{{ route('admin.domain-prices.update', $ext->id) }}" method="POST" style="display: none;">
                @csrf
            </form>

            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4">
                    <div class="font-bold text-slate-800">{{ $ext->extension }}</div>
                    <div class="text-[10px] text-slate-400">{{ $ext->provider->name ?? 'Sağlayıcı Yok' }}</div>
                </td>

                <td class="px-4 py-4 text-center">
                    <input form="update-form-{{ $ext->id }}" type="number" step="0.01" name="register_price" value="{{ $ext->register_price }}" class="w-24 border rounded px-2 py-1 text-sm text-center">
                </td>
                <td class="px-4 py-4 text-center">
                    <input form="update-form-{{ $ext->id }}" type="number" step="0.01" name="renew_price" value="{{ $ext->renew_price }}" class="w-24 border rounded px-2 py-1 text-sm text-center">
                </td>
                <td class="px-4 py-4 text-center">
                    <input form="update-form-{{ $ext->id }}" type="number" step="0.01" name="transfer_price" value="{{ $ext->transfer_price }}" class="w-24 border rounded px-2 py-1 text-sm text-center">
                </td>
                <td class="px-4 py-4 text-center">
                    <input form="update-form-{{ $ext->id }}" type="checkbox" name="is_manual_override" value="1" {{ $ext->is_manual_override ? 'checked' : '' }} class="rounded text-emerald-600">
                </td>

                <td class="px-6 py-4 text-right">
                    <button form="update-form-{{ $ext->id }}" type="submit" class="bg-emerald-600 text-white text-xs font-bold py-2 px-4 rounded-lg hover:bg-emerald-700 transition shadow-sm">
                        Güncelle
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection