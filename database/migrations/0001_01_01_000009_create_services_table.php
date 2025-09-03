<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_title', 255);
            $table->enum('service_category', ['Security Printing', 'Digital Solutions']);
            $table->text('service_descriptions');
            $table->string('service_slug', 255)->unique();
            $table->string('image', 255);
            $table->integer('file_image_count')->default(0);
            $table->date('publish_date');
            $table->enum('visibility', ['public', 'private', 'draft'])->default('draft');
            $table->timestamps();
            
            $table->index('service_category', 'idx_services_category');
            $table->index('visibility', 'idx_services_visibility');
            $table->index('publish_date', 'idx_services_publish_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};