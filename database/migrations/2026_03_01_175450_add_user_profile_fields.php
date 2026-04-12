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
        //
        Schema::table('users', function (Blueprint $table) {
    $table->string('profile_photo')->nullable();
    $table->string('phone')->nullable();
    $table->string('location')->nullable();
    $table->string('qualification')->nullable();
    $table->text('skills')->nullable();
    $table->text('experience')->nullable();
    $table->string('job_role')->nullable();
    $table->string('resume')->nullable();
    $table->boolean('ready_to_work')->default(false);
});
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        //
    }
};
