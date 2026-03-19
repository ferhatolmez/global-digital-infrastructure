<?php

namespace App\Services\Provisioning;

use Illuminate\Support\Facades\Bus;
use App\Jobs\Provisioning\RegisterDomainJob;
use App\Jobs\Provisioning\CreateHostingJob;
use App\Jobs\Provisioning\InstallSslJob;
use Illuminate\Support\Facades\Log;

class OrchestratorService
{
    /**
     * Dokümandaki "Örnek sıralı işlem" akışını başlatır.
     */
    public function startProvisioningPipeline($orderId, $servicesToProvision)
    {
        Log::info("Orchestrator: {$orderId} numaralı siparişin zincirleme kurulumu başlatılıyor.");

        $chain = [];

        // Siparişte domain varsa zincire ekle
        if (in_array('domain', $servicesToProvision)) {
            $chain[] = new RegisterDomainJob($orderId);
        }

        // Siparişte hosting varsa zincire ekle
        if (in_array('hosting', $servicesToProvision)) {
            $chain[] = new CreateHostingJob($orderId);
            
            // Hosting varsa SSL'i de arkasına ekle (şimdilik job'u boş varsayıyoruz)
            // $chain[] = new InstallSslJob($orderId);
        }

        // Zinciri arka planda (Queue) sırayla çalıştır
        Bus::chain($chain)->catch(function (\Throwable $e) use ($orderId) {
            // Eğer zincirin herhangi bir halkası (örn: Domain) çökerse, 
            // diğerlerine (Hosting) geçmez ve buraya düşer.
            Log::error("Orchestrator Hatası: {$orderId} numaralı kurulum yarıda kesildi! Hata: " . $e->getMessage());
            
            // Dokümandaki "Hata durumunda admin uyarı sistemi" burada çalışır
            // Mail::to('admin@global.com')->send(new ProvisioningFailedMail($orderId));
            
        })->dispatch();

        return true;
    }
}