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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Logofolio');
            $table->string('hero_tagline')->default('Creative Branding Studio');
            $table->string('hero_title', 500)->default('Desain Logo yang <br><span class="text-gradient">Mendefinisikan</span> Bisnis Anda.');
            $table->text('hero_description')->nullable();
            $table->string('contact_whatsapp')->default('628123456789');
            $table->string('price_startup')->default('Rp 1,5 Jt');
            $table->string('price_professional')->default('Rp 3,5 Jt');
            $table->string('price_enterprise')->default('Rp 8,5 Jt');
            $table->string('instagram_url')->default('#');
            $table->string('dribbble_url')->default('#');
            $table->string('behance_url')->default('#');
            $table->string('linkedin_url')->default('#');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
