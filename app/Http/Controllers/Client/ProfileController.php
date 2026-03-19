<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('client.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Temel doğrulama kuralları
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            // İhtiyaca göre validation kuralları artırılabilir
        ]);

        // Sadece izin verilen alanları güncelle
        $user->update($request->only([
            'name', 'phone', 'company_name', 'tax_office', 'tax_number', 'address', 'city', 'country'
        ]));

        return back()->with('success', 'Profil ve fatura bilgileriniz başarıyla güncellendi.');
    }
}
