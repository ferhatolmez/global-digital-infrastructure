<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject'); // Konu
            $table->string('status')->default('open'); // open, answered, closed
            $table->string('priority')->default('medium'); // low, medium, high
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('tickets'); }
};
