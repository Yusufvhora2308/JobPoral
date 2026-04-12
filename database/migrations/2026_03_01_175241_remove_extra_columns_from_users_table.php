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
        Schema::table('users', function (Blueprint $table) {
            //
               Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'languages',
                'certificates',
                'work_experience',
                'job_type',
                'work_schedule',
                'preferred_location',
                'ready_to_work',
                'profile_image'
            ]);
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('languages')->nullable();
            $table->text('certificates')->nullable();
            $table->text('work_experience')->nullable();
            $table->string('job_type')->nullable();
            $table->string('work_schedule')->nullable();
            $table->string('preferred_location')->nullable();
            $table->boolean('ready_to_work')->default(false);
            $table->string('profile_image')->nullable();
        });
    }
};
