<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Campos del sistema financiero / KYC
            $table->foreignId('document_type_id')->constrained('document_types')->cascadeOnDelete();
            $table->string('document_number', 50);
            $table->date('birth_date');
            $table->foreignId('nationality_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnDelete();

            // Seguridad transaccional
            $table->string('transaction_pin')->nullable();

            $table->rememberToken();
            $table->timestamps();

            // Evita duplicar el mismo número para un mismo tipo de documento
            $table->unique(['document_type_id', 'document_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};