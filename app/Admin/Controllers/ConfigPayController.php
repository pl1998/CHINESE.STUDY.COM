<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ConfigPay;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;

class ConfigPayController extends AdminController
{
    /**
     * page index
     */
    public function index(Content $content)
    {
           // 自动创建一条数据（如不存在）
    $model = \App\Models\ConfigPay::firstOrCreate(['id' => 1]);
    return $content
        ->header('Paypal配置')
        ->description('')
        ->body($this->form()->edit($model->id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ConfigPay(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('paypal_client_id');
            $grid->column('paypal_secret');
            $grid->column('paypal_mode');
            $grid->column('currency');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            // $grid->setActionClass(Grid\Displayers\Actions::class); // 行操作按钮显示方式 图标方式
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                // $actions->disableDelete(); //  禁用删除
                // $actions->disableEdit();   //  禁用修改
                // $actions->disableQuickEdit(); //禁用快速修改(弹窗形式)
                // $actions->disableView(); //  禁用查看
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new ConfigPay(), function (Show $show) {
            $show->field('id');
            $show->field('paypal_client_id');
            $show->field('paypal_secret');
            $show->field('paypal_mode');
            $show->field('currency');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new ConfigPay(), function (Form $form) {
            $form->display('id');
            $form->text('paypal_client_id');
            $form->text('paypal_secret');
            $form->text('paypal_mode');
            $form->text('currency');
            $form->text('app_name');
    
            // 设置表单提交的URL
            $form->action(admin_url('config/pay/1'));
            // 设置表单提交方法
          
        });
    }
}
