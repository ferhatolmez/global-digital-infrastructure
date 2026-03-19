<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domain_extensions', function (Blueprint $table) {
            $table->id();
            $table->string('extension')->unique(); // Örn: .com, .net, .com.tr
            
            // Bu uzantı varsayılan olarak hangi API'den kaydedilecek?
            $table->foreignId('provider_id')->constrained('providers'); 
            
            // Fiyatlandırma (Decimal kullanarak kuruş hassasiyeti sağlıyoruz)
            $table->decimal('register_price', 10, 2)->default(0);
            $table->decimal('renew_price', 10, 2)->default(0);
            $table->decimal('transfer_price', 10, 2)->default(0);
            
            // Dokümandaki Özel Ayarlar
            $table->boolean('is_manual_override')->default(false); // Cron fiyatı ezmesin diye manuel override
            $table->boolean('check_premium')->default(false); // Premium domain sorgusu yapılsın mı?
            $table->boolean('whois_privacy_default')->default(false); // WHOIS gizliliği varsayılan mı?
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_extensions');
    }
};