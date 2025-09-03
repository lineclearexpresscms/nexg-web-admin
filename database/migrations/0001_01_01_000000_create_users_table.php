<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 8)->primary()->comment('Format: NEXG0000');
            $table->string('avatar_image', 255)->nullable()->default(null);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('username', 50)->unique();
            $table->string('password', 255)->comment('Hashed password');
            $table->unsignedBigInteger('role_id');
            $table->timestamp('last_login_access')->nullable()->default(null);
            $table->json('role_permissions')->nullable()->default(null);
            $table->boolean('is_active')->default(true);
            $table->string('remember_token', 100)->nullable()->default(null);
            $table->timestamps();

            // Indexes
            $table->index('email', 'idx_users_email');
            $table->index('username', 'idx_users_username');
            $table->index('user_id', 'idx_users_user_id');
            $table->index('role_id', 'idx_users_role_id');
            $table->index('is_active', 'idx_users_is_active');
        });

        // Create trigger for auto-generating user_id
        DB::unprepared('
            CREATE TRIGGER generate_user_id_before_insert 
            BEFORE INSERT ON users 
            FOR EACH ROW 
            BEGIN
                DECLARE new_user_id VARCHAR(8);
                DECLARE id_exists INT DEFAULT 1;
                
                WHILE id_exists = 1 DO
                    SET new_user_id = CONCAT("NEXG", LPAD(FLOOR(RAND() * 10000), 4, "0"));
                    SELECT COUNT(*) INTO id_exists FROM users WHERE user_id = new_user_id;
                END WHILE;
                
                SET NEW.user_id = new_user_id;
            END
        ');

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS generate_user_id_before_insert');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
