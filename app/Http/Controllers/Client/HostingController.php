<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\HostingPackage;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    public function index()
    {
        // Aktif olan tüm paketleri getir
        $packages = HostingPackage::where('is_active', true)->get();
        
        return view('client.hosting.index', compact('packages'));
    }
}
