<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('domain_name')->unique();
            $table->string('status')->default('active'); // active, expired, pending
            $table->date('registration_date');
            $table->date('expiry_date');
            $table->string('ns1')->default('ns1.gda-altyapi.com');
            $table->string('ns2')->default('ns2.gda-altyapi.com');
            $table->boolean('auto_renew')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_domains');
    }
};
