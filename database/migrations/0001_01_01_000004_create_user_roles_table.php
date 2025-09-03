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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 8);
            $table->unsignedBigInteger('role_id');
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamps();
            
            // Composite unique constraint to prevent duplicate assignments
            $table->unique(['user_id', 'role_id'], 'unique_user_role');
            
            // Indexes as specified in your schema
            $table->index('user_id', 'idx_user_roles_user_id');
            $table->index('role_id', 'idx_user_roles_role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};