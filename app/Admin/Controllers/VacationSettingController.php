<?php

namespace App\Admin\Controllers;

use App\Models\VacationSetting;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use Carbon\Carbon;
use App\Admin\Traits\TimeZoneTrait;
use Illuminate\Support\Fluent;  

class VacationSettingController extends AdminController
{
    use TimeZoneTrait;

    protected $title = '假期设置';

    public function index(Content $content)
    {
        return $content
            ->header('假期设置（中国/上海时间）')
            ->description('列表')
            ->body($this->grid());
    }

    protected function grid()
    {
        return Grid::make(new VacationSetting(), function (Grid $grid) {
            $grid->column('id', 'ID')->sortable();
            $grid->column('name', '名称');
            $grid->column('start_date', '开始时间/国内时间');
            $grid->column('end_date', '结束时间/国内时间');
            $grid->column('is_active', '是否启用')->switch();
            $grid->column('created_at', '创建时间');
            $grid->column('updated_at', '更新时间');

            // 统一处理时间显示
            $this->handleTimeDisplay($grid);
        });
    }

    protected function form()
    {
        return Form::make(new VacationSetting(), function (Form $form) {
            $form->display('id');
            $form->text('name', '名称')->required();
            $form->datetime('start_date', '开始时间')
                ->format('YYYY-MM-DD HH:mm:ss')
                ->default(timezone_to_shanghai(Carbon::now()))
                ->help('中国/上海时间')
                ->required();
            $form->datetime('end_date', '结束时间')
                ->format('YYYY-MM-DD HH:mm:ss')
                ->default(timezone_to_shanghai(Carbon::now()))
                ->help('中国/上海时间')
                ->required();
            $form->switch('is_active', '是否启用')->default(1);
          
            
            $form->disableResetButton();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->disableViewCheck();
        });
    }
} 