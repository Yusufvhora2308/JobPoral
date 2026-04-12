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
        Schema::create('postjobs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');

        $table->string('job_title');
        $table->string('job_type'); // Full-time, Part-time, Internship
        $table->string('location');
        $table->string('experience_level'); // Fresher, 1-3 Years
        $table->string('salary')->nullable();
        
        $table->string('education')->nullable();

        $table->text('job_description');
        $table->text('requirements')->nullable();
        $table->text('skills')->nullable();

        $table->date('last_date')->nullable();
        $table->boolean('status')->default(1); // Active / Inactive

        $table->foreign('company_id')
              ->references('id')
              ->on('companies')
              ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postjobs');
    }
};
