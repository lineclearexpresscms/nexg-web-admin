<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('header_title', 255);
            $table->string('header_url', 500);
            $table->timestamps();
            
            $table->index('header_title', 'idx_headers_title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};