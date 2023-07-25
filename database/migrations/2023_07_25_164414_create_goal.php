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
        Schema::create('goal', function (Blueprint $table) {
            $table->uuid('goal_id')->primary();
            $table->decimal('goal_amount');
            $table->string('goal_name');
            $table->date('goal_start_date');
            $table->date('goal_end_date');
            $table->boolean('goal_is_completed')->default(false);
            $table->uuid('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
