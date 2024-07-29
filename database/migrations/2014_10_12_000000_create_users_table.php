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
            $table->uuid('id')->primary();
            $table->string('school_id', 15);
            $table->string('title', 20)->nullable();
            $table->string('fname', 30);
            $table->string('sname', 30);
            $table->string('mname', 30)->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('office_address', 100)->nullable();
            $table->string('phone_1', 20)->nullable()->unique();
            $table->string('phone_2', 20)->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('is_student', 1)->nullable();
            $table->string('is_admin', 1)->nullable();
            $table->string('is_adviser', 1)->nullable();
            $table->string('is_lecturer', 1)->nullable();
            $table->string('is_disabled', 1)->nullable();
            $table->uuid('face_enrolled', 1)->nullable();
            $table->string('admission_session');
            $table->timestamps();

            $table->unique(['phone_1', 'phone_2']);
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
