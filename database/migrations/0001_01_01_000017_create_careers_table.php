<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('job_title', 255);
            $table->text('job_description');
            $table->date('publish_date');
            $table->boolean('is_active')->default(true);
            $table->enum('visibility', ['public', 'private', 'draft'])->default('draft');
            $table->timestamps();
            
            $table->index('is_active', 'idx_careers_is_active');
            $table->index('visibility', 'idx_careers_visibility');
            $table->index('publish_date', 'idx_careers_publish_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};