<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hosting_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Örn: Başlangıç, Pro, Kurumsal
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Fiyat
            $table->string('billing_cycle')->default('1 Yıl'); // Fiyatlandırma periyodu
            $table->json('features')->nullable(); // Özellikler listesi (JSON)
            $table->boolean('is_recommended')->default(false); // Popüler paket etiketi için
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hosting_packages');
    }
};
