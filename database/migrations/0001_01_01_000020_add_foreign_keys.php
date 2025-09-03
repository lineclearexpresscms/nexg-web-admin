<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id', 'fk_users_role_id')
                  ->references('id')->on('roles')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });

        Schema::table('user_roles', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_user_roles_user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('role_id', 'fk_user_roles_role_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('leadership_team_members', function (Blueprint $table) {
            $table->foreign('leadership_team_id', 'fk_team_members_team_id')
                  ->references('id')->on('leadership_teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('leadership_team_members', function (Blueprint $table) {
            $table->dropForeign('fk_team_members_team_id');
        });
        
        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropForeign('fk_user_roles_user_id');
            $table->dropForeign('fk_user_roles_role_id');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('fk_users_role_id');
        });
    }
};