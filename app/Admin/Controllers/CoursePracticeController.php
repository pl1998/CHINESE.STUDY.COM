<?php

namespace App\Admin\Controllers;

use App\Models\CoursePractice;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class CoursePracticeController extends AdminController
{

    protected $title = '课程练习';

    protected function grid()
    {
        return Grid::make(new CoursePractice(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name', '课程名称');
            $grid->column('link', '课程链接')->link();
            $grid->column('audio', '课程语音')->display(function($audio){
                return $audio ? "<audio src='{$audio}' controls></audio>" : '';
            });
            $grid->column('cover', '课程封面')->image('', 100, 60);
            $grid->column('created_at');
            $grid->column('updated_at');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name');
            });
        });
    }

    protected function form()
    {
        
        return Form::make(new CoursePractice(), function (Form $form) {
            $form->text('name', '课程名称')->required();
            $form->url('link', '课程链接');
            $form->file('audio', '课程语音mp3')
            ->autoUpload()
            ->disk('public') // 使用 public 磁盘
            ->retainable()
            ->name(function ($file) {
                // 获取扩展名
                $ext = $file->getClientOriginalExtension();
                // 生成日期+随机字符串的文件名
                return 'audio/' . date('Ymd') . '_' . uniqid() . '.' . $ext;
            });
        
        $form->image('cover', '课程封面')
            ->autoUpload()
            ->retainable()
            ->disk('public') // 使用 public 磁盘
            ->name(function ($file) {
                $ext = $file->getClientOriginalExtension();
                return 'cover/' . date('Ymd') . '_' . uniqid() . '.' . $ext;
            });
        });
    }
}