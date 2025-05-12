<?php

namespace App\Admin\Controllers;

use App\Models\CourseLesson;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class CourseLessonController extends AdminController
{
    protected $title = '1v1课程列表';

    protected function grid()
    {
        return Grid::make(new CourseLesson(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name', '课程名称');
            $grid->column('description', '课程描述');
            $grid->column('cover', '课程封面')->image('', 100, 60);
            $grid->column('detail_image', '详情页图片')->image('', 100, 60);
            $grid->column('created_at');
            $grid->column('updated_at');
            $grid->filter(function (Grid\Filter $filter) {
             
                $filter->expand();
                $filter->panel();
                $filter->like('name', '课程名称')->width(width: 2);
             
            });
            $grid->model()->orderBy('id', 'desc');
        });
    }

    protected function form()
    {
        return Form::make(new CourseLesson(), function (Form $form) {
            $form->text('name', '课程名称')->required();
            $form->textarea('description', '课程描述');
            $form->image('cover', '课程封面')  ->autoUpload()
            ->name(function ($file) {
                $ext = $file->getClientOriginalExtension();
                return 'cover/' . date('Ymd') . '_' . uniqid() . '.' . $ext;
            });;
            $form->image('detail_image', '详情页图片')  ->autoUpload()
            ->name(function ($file) {
                $ext = $file->getClientOriginalExtension();
                return 'detail_image/' . date('Ymd') . '_' . uniqid() . '.' . $ext;
            });;
            $form->editor('content', '课程描述（富文本）')->options(['height' => 400, 'lang' => 'zh-CN']);
        });
    }
}