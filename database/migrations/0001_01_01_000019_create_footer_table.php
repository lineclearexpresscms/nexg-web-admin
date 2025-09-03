<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer', function (Blueprint $table) {
            $table->id();
            $table->string('footer_title', 255);
            $table->string('footer_url', 500);
            $table->timestamps();
            
            $table->index('footer_title', 'idx_footer_title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer');
    }
};