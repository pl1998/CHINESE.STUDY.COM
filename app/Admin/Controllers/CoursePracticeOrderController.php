<?php

namespace App\Admin\Controllers;

use App\Models\CoursePracticeOrder;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class CoursePracticeOrderController extends AdminController
{
    protected $title = '课程练习订单';

    protected function grid()
    {
        return Grid::make(new CoursePracticeOrder(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('practice_id', '课程ID');
            $grid->column('name', '姓名');
            $grid->column('email', '邮箱');
            $grid->column('order_no', '订单号');
            $grid->column('pay_price', '支付金额');
            $grid->column('pay_status', '支付状态')->display(function ($pay_status) {
                $status = [
                    CoursePracticeOrder::PAY_NOT => '未支付',
                    CoursePracticeOrder::PAY_SUCCESS => '已支付',
                    CoursePracticeOrder::PAY_CANCEL => '已取消'
                ];
                return $status[$pay_status] ?? '未知状态';
            });
            $grid->column('pay_time', '支付时间')->display(function ($pay_time) {
                return $pay_time ? date('Y-m-d H:i:s', $pay_time) : '-';
            });
            $grid->column('created_at', '创建时间');
            $grid->column('updated_at', '更新时间');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->panel();
                $filter->equal('practice_id', '课程ID')->width(width: 1);
                $filter->like('name', '姓名')->width(width: 1);
                $filter->like('email', '邮箱')->width(width: 1);
                $filter->like('order_no', '订单号')->width(width: 1);
                $filter->equal('pay_status', '支付状态')->select([
                    CoursePracticeOrder::PAY_NOT => '未支付',
                    CoursePracticeOrder::PAY_SUCCESS => '已支付',
                    CoursePracticeOrder::PAY_CANCEL => '已取消'
                ])->width(width: 1);
                $filter->between('created_at', '创建时间')->datetime()->width(width: 2); 
            });

            // 禁用创建按钮
            $grid->disableCreateButton();
            // 禁用编辑按钮
            $grid->disableEditButton();
            // 禁用删除按钮
            $grid->disableDeleteButton();
            // 禁用批量删除
            $grid->disableBatchDelete();
            $grid->disableViewButton();
            $grid->model()->orderBy('id', 'desc');
        });
    }
}