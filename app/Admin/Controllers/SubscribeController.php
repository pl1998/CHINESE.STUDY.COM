<?php

namespace App\Admin\Controllers;

use App\Models\Subscribe;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SubscribeController extends AdminController
{
    protected $title = '订阅邮箱列表';

    protected function grid()
    {
        return Grid::make(new Subscribe(), function (Grid $grid) {
            $grid->column('id', 'ID')->sortable();
            $grid->column('email', 'Email');
            $grid->column('created_at', '提交时间');
      

            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->panel();
                $filter->like('email', 'Email')->width(width: 2);
            });
               // 禁用所有操作按钮
               $grid->disableActions();
               $grid->disableCreateButton();
               $grid->disableDeleteButton();
               $grid->disableEditButton();
               $grid->disableViewButton();
               $grid->model()->orderBy('id', 'desc');
        });
    }

    protected function detail($id)
    {
        return Show::make($id, new Subscribe(), function (Show $show) {
            $show->field('id', 'ID');
            $show->field('email', 'Email');
            $show->field('created_at', 'Created At');
            $show->field('updated_at', 'Updated At');
        });
    }

    protected function form()
    {
        return Form::make(new Subscribe(), function (Form $form) {
            $form->display('id', 'ID');
            $form->email('email', 'Email')->required();
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}