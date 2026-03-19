<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessOrderProvisioning implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        $this->order->update(['status' => 'provisioning']);
        Log::info("Sipariş No: {$this->order->order_number} için Provisioning başladı.");

        try {
            foreach ($this->order->items as $item) {
                // Veritabanındaki sütun adlarına göre kontrol (product_type)
                if ($item->product_type == 'domain') {
                    $this->provisionDomain($item);
                } 
                elseif ($item->product_type == 'hosting') {
                    $this->provisionHosting($item);
                }
            }

            $this->order->update(['status' => 'active']);
            Log::info("Sipariş No: {$this->order->order_number} BAŞARIYLA TAMAMLANDI.");

        } catch (\Exception $e) {
            Log::error("Provisioning Kök Hatası | Sipariş No: {$this->order->order_number} - Hata: " . $e->getMessage());
            $this->order->update(['status' => 'failed']);
            throw $e;
        }
    }

    /**
     * Akıllı Domain Kurulum Mantığı (Fallback Korumalı)
     */
    protected function provisionDomain($item, $provider = null)
    {
        // Eğer sağlayıcı dışarıdan verilmediyse (ilk çağrıysa), 1. öncelikli aktif sağlayıcıyı bul
        if (!$provider) {
            $provider = Provider::where('service_type', 'domain')->where('is_active', true)->orderBy('priority')->first();
        }

        if (!$provider) {
            throw new \Exception("Domain kaydı için aktif bir sağlayıcı bulunamadı!");
        }

        Log::info("İşlem Deneniyor: {$item->product_name} | API: {$provider->name}");

        try {
            // BURASI GERÇEK API ÇAĞRISININ YAPILACAĞI YER
            // Örnek: $response = Http::post($provider->endpoint_url, ...);
            
            // --- TEST İÇİN SİMÜLASYON ---
            // Eğer Fallback mantığını test etmek istersen aşağıdaki satırı aktif et (başındaki // işaretini sil)
            //throw new \Exception("API Bağlantı Zaman Aşımı (Timeout)!");
            
            sleep(2); // Başarılı API simülasyonu
            Log::info("BAŞARILI: {$item->product_name} - {$provider->name} üzerinden kaydedildi.");

        } catch (\Exception $e) {
            Log::warning("BAŞARISIZ: {$provider->name} API yanıt vermedi. Hata: " . $e->getMessage());

            // Sağlayıcının bir yedeği (fallback) var mı kontrol et
            if ($provider->fallbackProvider && $provider->fallbackProvider->is_active) {
                Log::info("SİSTEM YEDEK SAĞLAYICIYA GEÇİYOR -> Yeni API: {$provider->fallbackProvider->name}");
                
                // Kendi kendini yedek sağlayıcı ile tekrar çağırır (Recursive)
                $this->provisionDomain($item, $provider->fallbackProvider);
            } else {
                Log::error("KRİTİK: Yedek sağlayıcı yok veya pasif! İşlem mecburen iptal edildi.");
                throw $e; // Siparişi failed yapmak için hatayı yukarı fırlat
            }
        }
    }

    /**
     * Akıllı Hosting Kurulum Mantığı (Fallback Korumalı)
     */
    protected function provisionHosting($item, $provider = null)
    {
        if (!$provider) {
            $provider = Provider::where('service_type', 'hosting')->where('is_active', true)->orderBy('priority')->first();
        }

        if (!$provider) {
            throw new \Exception("Hosting kaydı için aktif bir sağlayıcı bulunamadı!");
        }

        Log::info("İşlem Deneniyor: {$item->product_name} | API: {$provider->name}");

        try {
            // WHM/cPanel API Çağrısı Simülasyonu
            // throw new \Exception("WHM Sunucu Hatası (500)!");
            sleep(3);
            Log::info("BAŞARILI: {$item->product_name} - {$provider->name} üzerinden açıldı.");

        } catch (\Exception $e) {
            Log::warning("BAŞARISIZ: {$provider->name} API hatası. Hata: " . $e->getMessage());

            if ($provider->fallbackProvider && $provider->fallbackProvider->is_active) {
                Log::info("SİSTEM YEDEK SAĞLAYICIYA GEÇİYOR -> Yeni API: {$provider->fallbackProvider->name}");
                $this->provisionHosting($item, $provider->fallbackProvider);
            } else {
                Log::error("KRİTİK: Yedek sağlayıcı yok veya pasif! İşlem mecburen iptal edildi.");
                throw $e;
            }
        }
    }
}