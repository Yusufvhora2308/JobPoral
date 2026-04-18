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
        Schema::create('companyreviews', function (Blueprint $table) {
            $table->id();
                    $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->integer('rating'); // ⭐ overall rating (1-5)

            $table->integer('work_culture'); // 1-5
            $table->integer('salary'); // 1-5
            $table->integer('growth'); // 1-5

            $table->text('review')->nullable();


            // 🔥 One user = one review per company
            $table->unique(['company_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companyreviews');
    }
};
