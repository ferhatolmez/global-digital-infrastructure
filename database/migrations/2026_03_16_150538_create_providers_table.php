<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Örn: Vultr, GoDaddy, Stripe
            $table->string('service_type'); // domain, hosting, cloud, ssl, payment, smtp
            
            // Güvenlik: Bu alanlar veritabanında düz metin olarak DEĞİL, şifreli duracak.
            $table->text('api_key')->nullable(); 
            $table->text('secret_key')->nullable(); 
            
            $table->string('endpoint_url')->nullable();
            $table->string('region')->nullable(); // Örn: eu-central-1
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0); // 1 en yüksek öncelik
            
            // Fallback (Yedek) Sağlayıcı İlişkisi (Aynı tabloya referans)
            $table->foreignId('fallback_provider_id')
                  ->nullable()
                  ->constrained('providers')
                  ->nullOnDelete(); // Yedek sağlayıcı silinirse, bu alan null olsun
            
            $table->timestamp('last_successful_connection')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Yanlışlıkla silinmelere karşı koruma
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
