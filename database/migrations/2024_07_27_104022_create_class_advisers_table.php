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
        Schema::create('class_advisers', function (Blueprint $table) {
            $table->uuid();
            $table->foreignUuid('user_id')->constrained();
            $table->string('session', 9); // tied to users = admission_session
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_advisers');
    }
};
