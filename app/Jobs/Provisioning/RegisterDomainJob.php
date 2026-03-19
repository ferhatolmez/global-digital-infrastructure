<?php

namespace App\Jobs\Provisioning;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RegisterDomainJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $orderId;
    public $tries = 3; // Dokümandaki: Hata verirse 3 kez tekrar dene

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle()
{
    // 1. Sipariş kalemini ve siparişi bulalım
    $item = \App\Models\OrderItem::find($this->orderId);
    
    if (!$item) return;

    $order = \App\Models\Order::find($item->order_id);

    // 2. SİHİRLİ DOKUNUŞ: Siparişi gerçek bir domain varlığına dönüştür
    \App\Models\Domain::create([
        'user_id'       => $order->user_id,
        'domain_name'   => $item->product_name,
        'status'        => 'active',
        'registered_at' => now(),
        'expires_at'    => now()->addYear(),
        'nameservers'   => [
            'ns1' => 'ns1.global-altyapi.com', 
            'ns2' => 'ns2.global-altyapi.com'
        ],
        'auto_renew'    => true,
        'transfer_lock' => true
    ]);

    // Opsiyonel: Burada gerçek bir API'ye (Örn: GoDaddy) istek atacak kodlar gelebilir.
}
}
