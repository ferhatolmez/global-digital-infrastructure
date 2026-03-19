<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Sahibi (Müşteri)
            
            $table->string('domain_name')->unique(); // Örn: global-altyapi.com
            
            // Dokümandaki Müşteri Paneli Durumları
            // pending, active, expiring, expired, transferring, suspended
            $table->string('status')->default('active'); 
            
            // Tarihler
            $table->date('registered_at')->nullable();
            $table->date('expires_at')->nullable();
            
            // Yönetim Fonksiyonları
            $table->boolean('auto_renew')->default(true);
            $table->boolean('transfer_lock')->default(true);
            $table->boolean('whois_privacy')->default(false);
            
            // DNS Kayıtları (JSON formatında esnek tutuyoruz)
            $table->json('nameservers')->nullable(); 
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};