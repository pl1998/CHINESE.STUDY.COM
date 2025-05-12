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
        Schema::table('course_reservation', function (Blueprint $table) {
            $table->string('phone_dial_code', 10)->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_reservation', function (Blueprint $table) {
            $table->dropColumn('phone_dial_code');
        });
    }
};
