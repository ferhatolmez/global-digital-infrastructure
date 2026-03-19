<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Müşterinin tüm siparişlerini listeler
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('client.orders.index', compact('orders'));
    }

    // Fatura / Sipariş Detay Ekranı
    public function show($id)
    {
        // Siparişi ve içindeki ürünleri (items) getiriyoruz
        $order = Order::with('items')->where('user_id', Auth::id())->findOrFail($id);
        return view('client.orders.show', compact('order'));
    }
}
