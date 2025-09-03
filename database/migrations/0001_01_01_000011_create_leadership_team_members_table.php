<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leadership_team_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leadership_team_id');
            $table->string('member_name', 255);
            $table->string('member_position', 255);
            $table->text('member_description')->nullable();
            $table->string('member_image', 255)->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('leadership_team_id', 'idx_team_members_team_id');
            $table->index('display_order', 'idx_team_members_display_order');
            $table->index('is_active', 'idx_team_members_is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leadership_team_members');
    }
};