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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('user_name');
            $table->string('user_email')->unique();
            $table->timestamp('user_email_verified_at')->nullable();
            $table->string('user_password');
            $table->rememberToken();
            $table->timestamps();
            $table->index(['user_name', 'user_email'], 'user_name_email_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
