<?php

namespace App\Admin\Controllers;

use App\Models\CoursePracticeTopic;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
class CoursePracticeTopicController extends AdminController
{
    protected $title = '课程联系留言';
    protected function grid()
    {
        return Grid::make(new CoursePracticeTopic(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('practice_id', 'Practice ID')->sortable();
            $grid->column('name', 'Name');
            $grid->column('email', 'Email');
            $grid->column('website', 'Website');
            $grid->column('content', 'Content')->limit(50);
            $grid->column('is_show', '是否展示')->options()->select([0 => '否', 1 => '是']);
            
            $grid->column('created_at', '留言时间')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('practice_id', 'Practice ID');
                $filter->like('name', 'Name');
                $filter->like('email', 'Email');
                $filter->equal('is_show', '是否展示')->select([0 => '否', 1 => '是']);
                $filter->between('created_at', '留言时间')->datetime();
            });

            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();
            $grid->model()->orderBy('id', 'desc');
        });
    }

    protected function form()
    {
        return Form::make(new CoursePracticeTopic(), function (Form $form) {
            $form->display('id');
            $form->text('practice_id', 'Practice ID');
            $form->text('name', 'Name');
            $form->text('email', 'Email');
            $form->text('website', 'Website');
            $form->text('content', 'Content');
            $form->text('is_show', '是否展示');
        });
    }
}