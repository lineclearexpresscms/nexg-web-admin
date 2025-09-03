<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slide_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->date('valid_from')->comment('Format: dd/MM/YYYY');
            $table->date('valid_to')->comment('Format: dd/MM/YYYY');
            $table->string('image', 255);
            $table->boolean('is_active')->default(true);
            $table->string('link_url', 500)->nullable();
            $table->timestamps();
            
            $table->index('is_active', 'idx_slide_banners_is_active');
            $table->index('valid_from', 'idx_slide_banners_valid_from');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slide_banners');
    }
};