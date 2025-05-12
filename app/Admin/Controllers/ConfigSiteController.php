<?php

namespace App\Admin\Controllers;

use App\Models\ConfigSite;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Illuminate\Support\Facades\Cache;
use App\Enum\CacheEnum;

class ConfigSiteController extends AdminController
{
    protected $title = '网站配置';

    
    /**
     * page index
     */
    public function index(Content $content)
    {
           // 自动创建一条数据（如不存在）
    $model = \App\Models\ConfigSite::firstOrCreate(['id' => 1]);
    return $content
        ->header('网站配置')
        ->description('')
        ->body($this->form()->edit($model->id));
    }

    protected function grid()
    {
        return Grid::make(new ConfigSite(), function (Grid $grid) {
            $grid->column('id', 'ID')->sortable();
            $grid->column('instagram_url', 'Instagram链接');
            $grid->column('tiktok_url', 'TikTok链接');
            $grid->column('youtube_url', 'YouTube链接');
            $grid->column('ipone', '电话');
            $grid->column('email', '邮箱');
            $grid->column('created_at', '创建时间');
            $grid->column('updated_at', '更新时间');

            // 禁用创建按钮
            $grid->disableCreateButton();
            // 禁用删除按钮
            $grid->disableDeleteButton();
            // 禁用批量删除
            $grid->disableBatchDelete();
            // 禁用行选择器
            $grid->disableRowSelector();
            // 禁用分页
            $grid->disablePagination();
            // 禁用筛选
            $grid->disableFilter();
            // 禁用导出
            $grid->disableExport();
            // 禁用工具栏
            $grid->disableToolbar();
        });
    }

    protected function form()
    {
        return Form::make(new ConfigSite(), function (Form $form) {
            $form->display('id', 'ID');
            $form->url('instagram_url', 'Instagram链接');
            $form->url('tiktok_url', 'TikTok链接');
            $form->url('youtube_url', 'YouTube链接');
            $form->text('ipone', '电话');
            $form->email('email', '邮箱');
      

            // 禁用删除按钮
            $form->disableDeleteButton();
            // 禁用重置按钮
            $form->disableResetButton();
            // 禁用继续编辑按钮
            $form->disableEditingCheck();
            // 禁用继续创建按钮
            $form->disableCreatingCheck();
            // 禁用查看按钮
            $form->disableViewButton();
            $form->action(admin_url('config/site/1'));
            $form->saved(function (Form $form) {
                Cache::forget(CacheEnum::CONFIG_SITE);
            });
        });
    }
}