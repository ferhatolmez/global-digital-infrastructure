<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Provisioning\OrchestratorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Sepete Ekle
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // Basit bir benzersiz ID oluşturuyoruz
        $cartId = uniqid(); 
        
        $cart[$cartId] = [
            'type' => 'domain',
            'name' => $request->full_domain,
            'price' => $request->price,
            'ext_id' => $request->ext_id,
        ];

        session()->put('cart', $cart);

        return redirect()->route('client.cart.index')->with('success', 'Ürün sepete eklendi!');
    }

    // Sepeti Görüntüle
public function index()
    {
        $cart = Session::get('cart', []);
        
        // Sepet toplamını hesapla
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'];
        }

        return view('client.cart.index', compact('cart', 'total'));
    }

    /**
     * Domaini sepete ekler.
     */

    // Hosting Paketini Sepete Ekle
    public function addHosting(Request $request)
    {
        $cart = session()->get('cart', []);

        // Sepete eklenecek benzersiz bir anahtar oluşturalım
        $id = 'hosting_' . $request->package_id;

        $cart[$id] = [
            "name" => $request->name,
            "price" => $request->price,
            "period" => $request->period,
            "type" => "hosting",
            "id" => $request->package_id
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Hosting paketi sepete eklendi!');
    }

    // Domaini Sepete Ekle
    public function addDomain(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = 'domain_' . $request->domain_name;

        $cart[$id] = [
            "name" => $request->domain_name,
            "price" => $request->price,
            "period" => $request->period,
            "type" => "domain",
            "id" => $request->domain_name
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Alan adı sepete eklendi!');
    }

    // Sepetten Ürün Sil
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı.');
    }

    // Ödemeyi Tamamla ve Orkestrasyonu Başlat!
    public function checkout(OrchestratorService $orchestrator)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('client.domains.search')->with('error', 'Sepetiniz boş.');
        }

        $total = array_sum(array_column($cart, 'price'));

        // 1. Siparişi Veritabanına Kaydet
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'completed', // Şimdilik anında ödendi varsayıyoruz
        ]);

        $servicesToProvision = [];

        // 2. Sipariş Kalemlerini Kaydet ve Hizmet Türlerini Belirle
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_type' => $item['type'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'details' => ['ext_id' => $item['ext_id'] ?? null]
            ]);

            if (!in_array($item['type'], $servicesToProvision)) {
                $servicesToProvision[] = $item['type']; // Örn: ['domain']
            }
        }

        // 3. Sepeti Temizle
        session()->forget('cart');

        // 4. İŞTE O SİHİRLİ AN: Orkestrasyon Motorunu Tetikle!
        $orchestrator->startProvisioningPipeline($order->id, $servicesToProvision);

        return redirect()->route('client.dashboard')->with('success', 'Siparişiniz alındı! Kurulum işlemleri arka planda başlatıldı.');
    }
}