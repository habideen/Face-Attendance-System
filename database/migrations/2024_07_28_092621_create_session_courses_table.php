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
        Schema::create('session_courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_id')->constrained();
            $table->string('session', 9);
            $table->unsignedTinyInteger('classes_taken')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_courses');
    }
};
