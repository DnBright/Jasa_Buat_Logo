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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('package_type');
            $table->string('logo_name');
            $table->string('tagline')->nullable();
            $table->string('color_preferences')->nullable();
            $table->text('description_philosophy');
            $table->decimal('price', 10, 2);
            $table->string('status')->default('Menunggu Pembayaran'); // Menunggu Pembayaran, Proses Desain, Revisi, Selesai
            $table->string('payment_status')->default('Pending'); // Pending, Paid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
