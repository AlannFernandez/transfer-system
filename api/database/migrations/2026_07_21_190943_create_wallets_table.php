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
       Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('currency', 3)->default('USD'); // USD, ARS, EUR, etc.
            $table->decimal('balance', 15, 4)->default(0.0000);
            $table->enum('status', ['active', 'frozen', 'closed'])->default('active');
            $table->timestamps();

            // Garantiza que un usuario no tenga dos billeteras de la misma moneda
            $table->unique(['user_id', 'currency']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
