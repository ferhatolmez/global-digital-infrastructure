<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HostingPackage;
use Illuminate\Support\Facades\Log;

class SyncPrices extends Command
{
    // Komutun terminalde nasıl çağrılacağı
    protected $signature = 'prices:sync';

    // Komutun açıklaması
    protected $description = 'API sağlayıcılarından güncel kurları ve fiyatları çeker, veritabanını günceller.';

    public function handle()
    {
        $this->info('Fiyat senkronizasyonu başlatılıyor...');
        Log::info('Fiyat Senkronizasyonu (Cron) Başladı.');

        try {
            // BURADA GERÇEK BİR KUR API'SİNE (Örn: TCMB veya ExchangeRate-API) BAĞLANABİLİRSİNİZ.
            // Şimdilik Dolar kurunu sanal olarak çekiyoruz.
            $dolarKuru = 36.50; // Örnek güncel kur

            // 1. Hosting Paketlerini Güncelleme Simülasyonu
            // (Örneğin altyapı maliyetimiz Dolar bazlıysa, fiyatları kura göre ayarlayabiliriz)
            $packages = HostingPackage::all();
            
            foreach ($packages as $package) {
                // Sadece örnek bir fiyat artış/azalış algoritması
                // Eğer paket Kurumsal ise kura göre daha fazla etkilensin vs.
                $eskiFiyat = $package->price;
                
                // Diyelim ki baz fiyatı 5 USD. (5 * 36.50 = 182.50 TL)
                // Şimdilik sadece sembolik %2'lik bir kur artışı yansıtıyoruz:
                $yeniFiyat = $eskiFiyat * 1.02; 
                
                $package->update(['price' => $yeniFiyat]);
                
                $this->info("{$package->name} paketi güncellendi: {$eskiFiyat} ₺ -> " . number_format($yeniFiyat, 2) . " ₺");
            }

            // 2. Domain Uzantı Fiyatlarını Güncelleme (Eğer DomainExtension tablon varsa)
            // Namecheap API'sine istek atıp .com fiyatı kaç USD ise TL'ye çevirip veritabanına yazılır.

            $this->info('Senkronizasyon başarıyla tamamlandı.');
            Log::info('Fiyat Senkronizasyonu Başarıyla Tamamlandı.');

        } catch (\Exception $e) {
            $this->error('Senkronizasyon sırasında hata oluştu: ' . $e->getMessage());
            Log::error('Fiyat Senkronizasyon Hatası: ' . $e->getMessage());
        }
    }
}
