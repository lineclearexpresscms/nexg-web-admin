<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events_activities', function (Blueprint $table) {
            $table->id();
            $table->string('event_title', 255);
            $table->text('event_descriptions');
            $table->string('event_slug', 255)->unique();
            $table->string('event_category', 100);
            $table->string('event_image_cover', 255);
            $table->year('year');
            $table->json('image_gallery')->nullable();
            $table->integer('file_image_count')->default(0);
            $table->date('publish_date');
            $table->enum('visibility', ['public', 'private', 'draft'])->default('draft');
            $table->timestamps();
            
            $table->index('event_category', 'idx_events_activities_category');
            $table->index('year', 'idx_events_activities_year');
            $table->index('visibility', 'idx_events_activities_visibility');
            $table->index('publish_date', 'idx_events_activities_publish_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events_activities');
    }
};