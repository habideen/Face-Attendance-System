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
        Schema::create('course_attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('session_course_id')->constrained();
            $table->foreignUuid('lecturer_id')->constrained('users');
            $table->unsignedSmallInteger('attendance_count')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_attendances');
    }
};
