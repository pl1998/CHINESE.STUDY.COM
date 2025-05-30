<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_records', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('email', 191);
            $table->string('message', 500);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_records');
    }
};