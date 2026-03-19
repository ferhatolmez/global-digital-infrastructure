<?php

namespace App\Jobs\Provisioning;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateHostingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $orderId;
    public $tries = 3;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle(): void
    {
        Log::info("Provisioning: {$this->orderId} numaralı sipariş için WHM/cPanel hesabı açılıyor.");
        
        // Burada Sunucu API (Örn: WHM) çağrılıp hesap açılacak
        sleep(3); 

        Log::info("Provisioning: Hosting hesabı başarıyla oluşturuldu.");
    }
}
