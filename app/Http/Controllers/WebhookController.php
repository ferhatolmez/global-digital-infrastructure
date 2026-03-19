<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebhookLog;
use App\Models\Order;
use App\Jobs\ProcessOrderProvisioning;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Ödeme sağlayıcılarından (Iyzico, Stripe vb.) gelen bildirimleri dinler.
     */
    public function handlePaymentWebhook(Request $request, $provider)
    {
        $payload = $request->all();
        $eventType = $request->input('event_type', 'unknown.event'); // Stripe vb. 'type' veya 'event' gönderebilir
        
        // Örnek: Sipariş numarasını payload'un içinden bulmaya çalış (API dökümanına göre değişir)
        $orderNumber = $request->input('order_id') ?? $request->input('merchant_oid') ?? null;

        // 1. Gelen Bildirimi Logla
        $log = WebhookLog::create([
            'provider' => $provider,
            'event_type' => $eventType,
            'payload' => $payload,
            'status' => 'pending',
            'order_number' => $orderNumber
        ]);

        try {
            // 2. Güvenlik ve İmza (Signature) Doğrulaması (Simülasyon)
            // Gerçek projede: $this->verifySignature($request, $provider);
            $secret = $request->header('x-provider-signature');
            if ($secret !== 'benim-gizli-webhook-sifrem' && env('APP_ENV') !== 'local') {
                throw new \Exception("Geçersiz Webhook İmzası!");
            }

            // 3. Olay Türüne Göre İşlem Yap (Payment Success)
            if ($eventType === 'payment.success') {
                
                if (!$orderNumber) {
                    throw new \Exception("Sipariş numarası payload içinde bulunamadı.");
                }

                // Siparişi veritabanında bul (pending durumunda olanları)
                $order = Order::where('order_number', $orderNumber)->where('status', 'pending')->first();

                if ($order) {
                    // Ödeme onaylandığına göre sipariş durumunu güncelle
                    $order->update(['status' => 'paid']);
                    
                    // VE EN ÖNEMLİSİ: ORKESTRASYON MOTORUNU (JOB) ŞİMDİ TETİKLE!
                    ProcessOrderProvisioning::dispatch($order);

                    $log->update(['status' => 'processed']);
                    Log::info("Webhook İşlendi: Sipariş {$orderNumber} ödendi ve kuruluma başlandı.");
                } else {
                    $log->update(['status' => 'error', 'error_message' => 'Sipariş bulunamadı veya zaten ödenmiş.']);
                }

            } elseif ($eventType === 'payment.failed') {
                // Ödeme başarısızsa siparişi iptal et
                if ($orderNumber) {
                    Order::where('order_number', $orderNumber)->update(['status' => 'cancelled']);
                }
                $log->update(['status' => 'processed']);
            }

            // Ödeme sağlayıcısına (Stripe/Iyzico) "Aldım, teşekkürler" mesajı dönüyoruz (200 OK)
            return response()->json(['message' => 'Webhook received successfully'], 200);

        } catch (\Exception $e) {
            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);
            
            Log::error("Webhook Hatası ({$provider}): " . $e->getMessage());
            
            // Eğer 400 dönersek bazı sağlayıcılar bildirimi daha sonra tekrar gönderir (Retry Mechanism)
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}