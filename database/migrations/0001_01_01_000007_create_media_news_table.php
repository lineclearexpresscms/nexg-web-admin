<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_news', function (Blueprint $table) {
            $table->id();
            $table->string('news_title', 255);
            $table->text('news_descriptions');
            $table->string('news_slug', 255)->unique();
            $table->string('news_category', 100);
            $table->string('news_image_cover', 255);
            $table->year('year');
            $table->json('image_gallery')->nullable();
            $table->integer('file_image_count')->default(0);
            $table->date('publish_date');
            $table->enum('visibility', ['public', 'private', 'draft'])->default('draft');
            $table->timestamps();
            
            $table->index('news_category', 'idx_media_news_category');
            $table->index('year', 'idx_media_news_year');
            $table->index('visibility', 'idx_media_news_visibility');
            $table->index('publish_date', 'idx_media_news_publish_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_news');
    }
};