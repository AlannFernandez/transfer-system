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
        Schema::table('wallets', function (Blueprint $table) {

            if (Schema::hasColumn('wallets', 'status')) {
                $table->dropColumn('status');
            }

            $table->foreignId('wallet_status_id')
                ->after('user_id')
                ->constrained('wallet_statuses');

            if (!Schema::hasColumn('wallets', 'held_balance')) {
                $table->decimal('held_balance', 15, 4)->default(0.0000)->after('balance');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropForeign(['wallet_status_id']);
            $table->dropColumn('wallet_status_id');
            $table->dropColumn('held_balance');
            $table->string('status')->default('active');
        });
    }
};
