<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            // Hangi sağlayıcıya ait (Örn: Vultr, Hetzner veya kendi veri merkezimiz)
            $table->foreignId('provider_id')->constrained('providers'); 
            
            $table->string('name'); // Örn: EU-Server-01
            $table->string('ip_address');
            $table->string('hostname')->nullable(); // Örn: srv1.globalaltyapi.com
            $table->string('region')->nullable();
            
            // Sunucuya özel API/WHM Token (Şifreli saklanacak)
            $table->text('api_token')->nullable(); 

            // Kaynak ve İzleme (Monitoring) Limitleri
            $table->integer('total_disk_gb')->default(0);
            $table->integer('total_ram_gb')->default(0);
            
            // Dokümandaki Özel Alanlar
            $table->string('health_check_url')->nullable();
            $table->integer('auto_scale_threshold_percent')->default(80); // %80 doluluğa ulaşınca uyarı/ölçekleme
            
            // Otomatik hesap oluşturma ve SSL kurulum izinleri
            $table->boolean('auto_create_accounts')->default(true);
            $table->boolean('auto_ssl_install')->default(true);
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};