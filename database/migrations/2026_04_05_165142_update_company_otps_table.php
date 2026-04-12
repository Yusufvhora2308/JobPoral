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
        Schema::table('company_otps', function (Blueprint $table) {
            //
             $table->dropColumn('company_id');   // ❌ remove
    $table->string('email')->after('id'); // ✅ add
    $table->boolean('is_used')->default(false)->after('otp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_otps', function (Blueprint $table) {
            //
        });
    }
};
