<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ConfigEmail;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Support\Facades\Cache;
use App\Enum\CacheEnum;

class ConfigEmailController extends AdminController
{
    /**
     * page index
     */public function index(Content $content)
{
    // 自动创建一条数据（如不存在）
    $model = \App\Models\ConfigEmail::firstOrCreate(['id' => 1]);
    return $content
        ->header('邮箱配置')
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
        return Grid::make(new ConfigEmail(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('mail_host','邮箱服务器');
            $grid->column('mail_port','邮箱端口');
            $grid->column('mail_username','邮箱账号');
            $grid->column('mail_password','邮箱密码');
            $grid->column('mail_encryption','邮箱加密');
            $grid->column('mail_from_address','邮箱发件人');
            $grid->column('mail_from_name','邮箱发件人名称');
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
        return Show::make($id, new ConfigEmail(), function (Show $show) {
            $show->field('id');
            $show->field('mail_host');
            $show->field('mail_port');
            $show->field('mail_username');
            $show->field('mail_password');
            $show->field('mail_encryption');
            $show->field('mail_from_address');
            $show->field('mail_from_name');
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
        return Form::make(new ConfigEmail(), function (Form $form) {
            $form->display('id');
            $form->text('mail_host','邮箱服务器');
            $form->text('mail_port','邮箱端口');
            $form->text('mail_username','邮箱账号');
            $form->text('mail_password','邮箱密码');
            $form->text('mail_encryption','邮箱加密');
            $form->text('mail_from_address','邮箱发件人');
            $form->text('mail_from_name','邮箱发件人名称');
            $form->action(admin_url('config/email/1'));
            $form->saved(function (Form $form) {
                Cache::forget(CacheEnum::CONFIG_EMAIL);
            });
        });
    }
}
