<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigPayTable extends Migration
{
    public function up()
    {
        Schema::create('config_pay', function (Blueprint $table) {
            $table->id();
            $table->string('paypal_client_id')->nullable()->comment('PayPal Client ID');
            $table->string('paypal_secret')->nullable()->comment('PayPal Secret');
            $table->string('paypal_mode')->default('sandbox')->comment('PayPal Mode: sandbox/live');
            $table->string('currency')->default('USD')->comment('Currency');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('config_pay');
    }
}