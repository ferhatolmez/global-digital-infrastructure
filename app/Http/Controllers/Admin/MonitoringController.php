<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebhookLog;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // 1. Sistem Sağlık Verileri (System Health)
        $activeProviders = Provider::where('is_active', true)->get();
        
        // Kuyruktaki ve hata veren işlerin sayısı (Veritabanı sürücüsü kullanıldığı varsayımıyla)
        $queueBacklog = DB::table('jobs')->count(); 
        
        // Laravel 11'de default olarak failed_jobs tablosu gelir
        $failedJobs = DB::table('failed_jobs')->count(); 

        // 2. Webhook Logları (Son gelenleri en üstte göster)
        $webhookLogs = WebhookLog::latest()->paginate(15);

        return view('admin.monitoring.index', compact(
            'activeProviders', 
            'queueBacklog', 
            'failedJobs', 
            'webhookLogs'
        ));
    }
}