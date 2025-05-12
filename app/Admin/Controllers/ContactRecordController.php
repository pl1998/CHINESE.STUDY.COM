<?php

namespace App\Admin\Controllers;

use App\Models\ContactRecord;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ContactRecordController extends AdminController
{
    protected $title = '联系记录列表';

    protected function grid()
    {
        return Grid::make(new ContactRecord(), function (Grid $grid) {
            $grid->column('id', 'ID')->sortable();
            $grid->column('name', '姓名');
            $grid->column('email', '邮箱');
            $grid->column('message', '留言内容');
            $grid->column('created_at', '提交时间');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->panel();
                $filter->like('name', '姓名')->width(width: 2);
                $filter->like('email', '邮箱')->width(width: 2);
                
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
        return Show::make($id, new ContactRecord(), function (Show $show) {
            $show->field('id', 'ID');
            $show->field('name', '姓名');
            $show->field('email', '邮箱');
            $show->field('message', '留言内容');
            $show->field('created_at', '创建时间');
            $show->field('updated_at', '更新时间');
        });
    }
}