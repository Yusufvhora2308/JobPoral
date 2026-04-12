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
        Schema::table('companies', function (Blueprint $table) {
            //
             $table->string('logo')->nullable()->after('email');
            $table->string('cover')->nullable()->after('logo');

            $table->text('description')->nullable()->after('cover');

            $table->string('website')->nullable()->after('description');
            $table->string('location')->nullable()->after('website');

            // 🔥 Extra Professional Fields
            $table->string('industry')->nullable()->after('location');
            $table->string('company_size')->nullable()->after('industry');
            $table->year('founded_year')->nullable()->after('company_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
