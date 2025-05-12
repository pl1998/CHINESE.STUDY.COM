<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 执行迁移
     */
    public function up(): void
    {
        Schema::create('course_reservation', function (Blueprint $table) {
            $table->increments('id')->comment('课程预约id');
            $table->string('email', 50)->default('')->comment('预约邮箱');
            $table->integer('start_time')->default(0)->comment('课程开始时间');
            $table->tinyInteger('pay_status')->comment('支付状态 0.未支付 1.已支付 2.支付失败');
            $table->tinyInteger('status')->default(0)->comment('0.未开始 1.已填充zoom地址 2.结束');
            $table->integer('end_time')->default(0)->comment('课程结束时间');
            $table->string('last_name', 50)->default('')->comment('姓');
            $table->string('fisrt_name', 50)->default('')->comment('名'); // 注意：原表中存在拼写错误'fisrt'
            $table->string('phone', 50)->default('')->comment('电话');
            $table->string('phone_dial_code', 10)->nullable();
            $table->decimal('pay_price', 10, 2)->default(0.00)->comment('支付金额');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('zoom_url', 255)->default('')->comment('zoom会议地址');
            $table->string('repeat', 255)->default('')->comment('重复预约内容');
            $table->string('order_no', 255)->default('')->comment('支付订单号');
            $table->string('transaction_id', 255)->default('')->comment('交易id');
            $table->string('pay_code', 255)->default('')->comment('交易code');
            $table->integer('pay_time')->default(0)->comment('支付时间');
        });
    }

    /**
     * 回滚迁移
     */
    public function down(): void
    {
        Schema::dropIfExists('course_reservation');
    }
};    