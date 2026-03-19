<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hosting_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Örn: Başlangıç Planı
            
            // WHM/cPanel tarafındaki tam paket adı (Örn: global_starter)
            $table->string('cpanel_package_name')->nullable();
            
            // Limitler
            $table->integer('disk_space_mb')->default(1024); // 1 GB
            $table->integer('bandwidth_mb')->default(10240); // 10 GB
            $table->integer('addon_domains')->default(0);
            $table->integer('subdomains')->default(5);
            $table->integer('email_accounts')->default(10);
            $table->integer('databases')->default(2);
            
            // Fiyatlandırma
            $table->decimal('monthly_price', 10, 2)->default(0);
            $table->decimal('yearly_price', 10, 2)->default(0);
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hosting_plans');
    }
};
