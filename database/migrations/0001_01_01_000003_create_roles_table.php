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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 50)->unique();
            $table->string('role_display_name', 100);
            $table->text('role_description')->nullable();
            $table->json('role_permissions');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Index as specified in your schema
            $table->index('is_active', 'idx_roles_is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};