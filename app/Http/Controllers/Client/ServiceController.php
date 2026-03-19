<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserSite;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // Aktif hizmetleri listele
    public function index()
    {
        // Müşteriye ait siteleri (hostingleri) getiriyoruz
        $services = UserSite::where('user_id', Auth::id())->latest()->get();
        return view('client.services.index', compact('services'));
    }

    // Hizmet detaylarını (FTP, IP, Veritabanı vb.) gör
    public function show($id)
    {
        $service = UserSite::where('user_id', Auth::id())->findOrFail($id);
        return view('client.services.show', compact('service'));
    }
}
