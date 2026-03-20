<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Events\TicketCreated;
use Illuminate\Support\Facades\Log;

class ProcessDomainRegistration implements ShouldQueue
{
    use Queueable;

    protected string $domain;

    /**
     * Create a new job instance.
     */
    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Simulate a slow API call to the registrar (5 seconds)
        sleep(5);
        
        Log::info("Domain registered successfully: {$this->domain}");

        // Real-time Notification via WebSockets / Reverb
        TicketCreated::dispatch("Tebrikler! {$this->domain} başarıyla tescil edildi ve aktifleşti.");
    }
}
