<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Jobs\ProcessOrderProvisioning;

class CheckoutController extends Controller
{
    /**
     * Ödeme sayfasını gösterir.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('client.cart.index')->with('error', 'Sepetiniz boş.');
        }

        $total = array_sum(array_column($cart, 'price'));

        return view('client.checkout.index', compact('cart', 'total'));
    }

    /**
     * Siparişi oluşturur ve sepeti temizler.
     */
    public function process(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('client.cart.index');
        }

        $total = array_sum(array_column($cart, 'price'));

        // 1. Ana Siparişi Oluştur
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6)),
            'total_amount' => $total,
            'status' => 'paid',
            'payment_method' => 'credit_card'
        ]);

        // 2. Sepetteki ürünleri OrderItem olarak kaydet
        foreach ($cart as $item) {
            
            // Sepetten gelen ismin hangi anahtarla kaydedildiğini buluyoruz (name, domain_name veya package_name olabilir)
            $itemName = $item['name'] ?? $item['domain_name'] ?? $item['package_name'] ?? 'Bilinmeyen Ürün';

            OrderItem::create([
                'order_id'     => $order->id,
                'product_type' => $item['type'] ?? 'unknown',
                'product_name' => $itemName, 
                'price'        => $item['price'] ?? 0,
                'period'       => $item['period'] ?? '1 Yıl', 
            ]);
        }

        // 3. ARKAPLAN GÖREVİNİ (JOB) BAŞLAT
        \App\Jobs\ProcessOrderProvisioning::dispatch($order);

        // 4. Sipariş tamamlandı, sepeti boşalt
        Session::forget('cart');

        // Başarılı sayfasına yönlendir
        return redirect()->route('client.checkout.success', $order->id);
    }

    /**
     * Sipariş başarılı sayfasını gösterir.
     */
    public function success(Order $order)
    {
        // Güvenlik: Sadece kendi siparişini görebilir
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('client.checkout.success', compact('order'));
    }
}