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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kumbung_id')->constrained('kumbungs')->onDelete('cascade');
            $table->float('amount');
            $table->enum('method', [
                'CREDIT_CARD',
                'BANK_TRANSFER',
                'E_WALLET'
            ]);
            $table->enum('status', [
                'PENDING',
                'SUCCESS',
                'FAILED'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
