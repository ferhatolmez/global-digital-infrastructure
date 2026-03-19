<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckExpiredDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-domains';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Bitiş tarihi bugünden küçük olan ve hala 'active' görünenleri bul
        $expiredDomains = \App\Models\UserDomain::where('expiry_date', '<', now())
            ->where('status', 'active')
            ->get();

        foreach ($expiredDomains as $domain) {
            $domain->update(['status' => 'expired']);
            $this->info($domain->domain_name . " süresi dolduğu için pasif yapıldı.");
        }
    }
}
