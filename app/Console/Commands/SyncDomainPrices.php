<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DomainExtension;
use App\Models\Provider;
use Illuminate\Support\Facades\Log;

class SyncDomainPrices extends Command
{
    // Terminalden veya cron'dan çağıracağımız komut adı
    protected $signature = 'domains:sync-prices';
    protected $description = 'Aktif sağlayıcılardan domain uzantılarının fiyatlarını çeker ve günceller.';

    public function handle()
    {
        $this->info('Fiyat senkronizasyonu başlatılıyor...');

        // Sadece manuel olarak fiyatı belirlenmemiş (otomatik) uzantıları sağlayıcılarına göre grupla
        $extensionsByProvider = DomainExtension::where('is_manual_override', false)
            ->where('is_active', true)
            ->with('provider')
            ->get()
            ->groupBy('provider_id');

        foreach ($extensionsByProvider as $providerId => $extensions) {
            $provider = $extensions->first()->provider;
            
            if (!$provider || !$provider->is_active) {
                continue;
            }

            $this->info("{$provider->name} sağlayıcısı için fiyatlar çekiliyor...");

            try {
                // Not: Burada Factory pattern ile Provider'ın servisini çağıracağız.
                // Şimdilik simüle ediyoruz (İleride burası dinamik servis sınıfı olacak)
                $prices = $this->simulateApiCall($provider, $extensions->pluck('extension')->toArray());

                // Fiyatları veritabanında güncelle
                foreach ($extensions as $ext) {
                    if (isset($prices[$ext->extension])) {
                        $ext->update([
                            'register_price' => $prices[$ext->extension]['register'],
                            'renew_price'    => $prices[$ext->extension]['renew'],
                            'transfer_price' => $prices[$ext->extension]['transfer'],
                        ]);
                        $this->line("- {$ext->extension} fiyatları güncellendi.");
                    }
                }
            } catch (\Exception $e) {
                Log::error("Fiyat senk. hatası ({$provider->name}): " . $e->getMessage());
                $this->error("Hata oluştu: " . $e->getMessage());
                
                // Dokümandaki Fallback (Yedek) mekanizması burada devreye girebilir
            }
        }

        $this->info('Fiyat senkronizasyonu tamamlandı!');
    }

    /**
     * Gerçek API entegrasyonu yapılana kadar fiyat dönüşünü simüle eden fonksiyon
     */
    private function simulateApiCall($provider, $extensions)
    {
        $mockPrices = [];
        foreach ($extensions as $ext) {
            $mockPrices[$ext] = [
                'register' => rand(8, 15) + 0.99,
                'renew'    => rand(10, 20) + 0.99,
                'transfer' => rand(8, 12) + 0.99,
            ];
        }
        return $mockPrices;
    }
}