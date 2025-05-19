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
        Schema::create('recorded_lesson', function (Blueprint $table) {
            $table->increments('id')->comment('主键id');
            $table->string('link', 500)->default('')->comment('跳转链接');
            $table->string('cover', 255)->default('')->comment('封面图');
            $table->string('name', 255)->default('')->comment('课程名称');
            $table->string('description', 1000)->default('')->comment('课程描述');
            $table->string('detail_image')->nullable()->comment('详情图片');
            $table->text('content')->nullable()->comment('课程内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recorded_lesson');
    }
}; 