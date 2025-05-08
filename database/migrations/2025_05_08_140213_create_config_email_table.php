<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigEmailTable extends Migration
{
    public function up()
    {
        Schema::create('config_email', function (Blueprint $table) {
            $table->id();
            $table->string('mail_host')->nullable()->comment('Mail Host');
            $table->string('mail_port')->nullable()->comment('Mail Port');
            $table->string('mail_username')->nullable()->comment('Mail Username');
            $table->string('mail_password')->nullable()->comment('Mail Password');
            $table->string('mail_encryption')->nullable()->comment('Mail Encryption');
            $table->string('mail_from_address')->nullable()->comment('Mail From Address');
            $table->string('mail_from_name')->nullable()->comment('Mail From Name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('config_email');
    }
}