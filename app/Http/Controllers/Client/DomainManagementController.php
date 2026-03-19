<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserDomain;
use Illuminate\Support\Facades\Auth;

class DomainManagementController extends Controller
{
    // Müşterinin domainlerini listeler
    public function index()
    {
        $domains = UserDomain::where('user_id', Auth::id())->latest()->get();
        return view('client.domains.my_domains', compact('domains'));
    }

    // Domain detay ve DNS yönetimi
    public function show($id)
    {
        $domain = UserDomain::where('user_id', Auth::id())->findOrFail($id);
        return view('client.domains.show_details', compact('domain'));
    }
}
