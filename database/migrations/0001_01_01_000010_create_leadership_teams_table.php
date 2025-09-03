<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leadership_teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_name', 255)->unique();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
            
            $table->index('display_order', 'idx_leadership_teams_display_order');
            $table->index('team_name', 'idx_leadership_teams_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leadership_teams');
    }
};