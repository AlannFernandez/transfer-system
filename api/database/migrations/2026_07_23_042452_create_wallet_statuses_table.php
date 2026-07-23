<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallet_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique(); // ej: 'active', 'frozen', 'closed'
            $table->string('name', 50);          // ej: 'Activa', 'Congelada', 'Cerrada'
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_statuses');
    }
};
