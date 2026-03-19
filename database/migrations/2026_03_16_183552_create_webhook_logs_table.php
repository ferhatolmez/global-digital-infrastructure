<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string('provider'); // iyzico, stripe, paypal vb.
            $table->string('event_type'); // payment.success, payment.failed vb.
            $table->json('payload'); // Gelen tüm veriyi burada tutacağız
            $table->string('status'); // processed (işlendi), failed (hatalı doğrulama), error
            $table->text('error_message')->nullable();
            $table->string('order_number')->nullable(); // Hangi siparişle eşleşti
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webhook_logs');
    }
};
