<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePracticeTable extends Migration
{
    public function up()
    {
        Schema::create('course_practice', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('课程名称');
            $table->string('link')->nullable()->comment('课程链接');
            $table->string('audio')->nullable()->comment('课程语音mp3');
            $table->string('cover')->nullable()->comment('课程封面');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_practice');
    }
}