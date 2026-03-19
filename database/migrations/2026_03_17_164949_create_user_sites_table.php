<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('domain_name'); // Hangi domain için yapılıyor?
            $table->longText('html_content')->nullable(); // Sürükle-bırak HTML çıktısı
            $table->longText('css_content')->nullable();  // Sürükle-bırak CSS çıktısı
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_sites');
    }
};
