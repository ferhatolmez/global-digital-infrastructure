<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PriceSyncController extends Controller
{
    /**
     * Senkronizasyon yönetim sayfasını gösterir
     */
    public function index()
    {
        return view('admin.prices.index');
    }

    /**
     * Fiyat senkronizasyon komutunu manuel tetikler
     */
    public function syncNow(Request $request)
    {
        try {
            // Arkada yazdığımız konsol komutunu tetikler
            Artisan::call('prices:sync');
            
            // Konsoldan dönen çıktı mesajını alır
            $output = Artisan::output();

            return back()->with('success', 'Fiyatlar başarıyla senkronize edildi. Sistem Çıktısı: ' . $output);
        } catch (\Exception $e) {
            return back()->with('error', 'Senkronizasyon başarısız: ' . $e->getMessage());
        }
    }
}