<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Provider;
use App\Models\WebhookLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Finansal Özet (Madde 3)
        $stats = [
            'total_revenue' => Order::where('status', 'paid')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'active_services' => Order::where('status', 'active')->count(),
            'failed_provisioning' => Order::where('status', 'failed')->count(),
        ];

        // 2. Sistem Sağlık Durumu (Madde 9)
        // API Sağlayıcılarının son bağlantı durumları
        $providerHealth = Provider::select('name', 'service_type', 'last_connected_at', 'is_active')->get();

        // 3. Son Webhook Aktiviteleri
        $recentWebhooks = WebhookLog::latest()->take(5)->get();

        // 4. Grafik Verisi: Son 7 günün sipariş trendi
        $chartData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->take(7)
            ->get();

        return view('admin.dashboard', compact('stats', 'providerHealth', 'recentWebhooks', 'chartData'));
    }
}