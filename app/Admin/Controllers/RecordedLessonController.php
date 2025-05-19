<?php

namespace App\Admin\Controllers;

use App\Models\RecordedLesson;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RecordedLessonController extends AdminController
{
    protected $title = '录播课程管理';

    protected function grid()
    {
        return Grid::make(new RecordedLesson(), function (Grid $grid) {
            $grid->column('id', 'ID')->sortable();
            $grid->column('name', '课程名称');
            $grid->column('description', '课程描述')->limit(50);
            $grid->column('cover', '封面图片')->image('', 100, 60);
            $grid->column('link', '跳转链接')->link();
            $grid->column('created_at', '创建时间');
            $grid->column('updated_at', '更新时间');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->panel();
                $filter->like('name', '课程名称')->width(2);
                $filter->like('description', '课程描述')->width(2);
                $filter->like('link', '跳转链接')->width(2);
                $filter->between('created_at', '创建时间')->datetime()->width(2);
            });

            $grid->model()->orderBy('id', 'desc');
        });
    }

    protected function detail($id)
    {
        return Show::make($id, new RecordedLesson(), function (Show $show) {
            $show->field('id', 'ID');
            $show->field('name', '课程名称');
            $show->field('description', '课程描述');
            $show->field('cover', '封面图片')->image('', 200, 120);
            $show->field('link', '跳转链接')->link();
            $show->field('created_at', '创建时间');
            $show->field('updated_at', '更新时间');
        });
    }

    protected function form()
    {
        return Form::make(new RecordedLesson(), function (Form $form) {
            $form->text('name', '课程名称')->required();
            $form->textarea('description', '课程描述')->rules('required|max:1000');
            $form->url('link', '跳转链接')->required();
            $form->image('cover', '封面图片')->required()
                ->autoUpload()
                ->disk('public')
                ->retainable()
                ->name(function ($file) {
                    return 'recorded_lesson/cover/' . date('Ymd') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                });
        });
    }
} 