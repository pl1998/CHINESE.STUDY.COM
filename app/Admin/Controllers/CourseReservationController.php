<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CourseReservation;
use App\Http\Traits\EmailConfig;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use App\Mail\ZoomUrlNotificationMail;
use Illuminate\Support\Facades\Mail;
class CourseReservationController extends AdminController
{
    use EmailConfig;
    /**
     * page index
     */
    public function index(Content $content)
    {
        return $content
            ->header('列表')
            ->description('全部')
            ->breadcrumb(['text'=>'列表','url'=>''])
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(CourseReservation::with('courseLesson'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('courseLesson.name', '预约课程');
            $grid->column('full_name', '姓名')->display(function () {
                return ($this->fisrt_name ?? '') . ' ' . ($this->last_name ?? '');
            });
            $grid->column('email');
            $grid->column('time_range', '预约时间')->display(function () {
             
                $start = $this->start_time ? (is_object($this->start_time) ? $this->start_time->format('Y-m-d H:i') : date('Y-m-d H:i', $this->start_time)) : '';
                $end = $this->end_time ? (is_object($this->end_time) ? $this->end_time->format('Y-m-d H:i') : date('Y-m-d H:i', $this->end_time)) : '';
                return $start && $end ? "{$start} ~ {$end}" : '';
            });
            $grid->column('pay_status', '支付状态')->using([
                0 => '未支付',
                1 => '已支付',
                2 => '支付失败',
            ]);
            $grid->column('status', '状态')->using([
                0 => '未开始',
                1 => '已填充zoom地址',
                2 => '结束',
            ]);
            $grid->column('phone');
            $grid->column('phone_dial_code', '区号');
            $grid->column('pay_price');
            $grid->column('zoom_url');
            $grid->column('repeat');
            $grid->column('order_no');
            $grid->column('transaction_id');
            $grid->column('pay_code');
            $grid->column('pay_time');
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
                $filter->expand();
                $filter->panel();
                $filter->equal('id')->width(width: 1);
                $filter->equal('email')->width(width: 1);
                $filter->equal('phone')->width(width: 1);
                $filter->in('pay_status')->multipleSelect([
                    '0' => '未支付',
                    '1' => '已支付',
                    '2' => '支付失败',
                ])->width(width: 2);
                $filter->in('status')->multipleSelect([
                    '0' => '未开始',
                    '1' => '已填充zoom地址',
                    '2' => '结束',
                ])->width(width: 2);
                $filter->like('courseLesson.name', '预约课程');
            });
            $grid->disableCreateButton();
            $grid->showFilter();
            $grid->model()->orderBy('id', 'desc');
        
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
        return Show::make($id, new CourseReservation(), function (Show $show) {
            $show->field('id');
            $show->field('email');
            $show->field('start_time');
            $show->field('pay_status');
            $show->field('status');
            $show->field('end_time');
            $show->field('phone');
            $show->field('phone_dial_code', '区号');
            $show->field('pay_price');
            $show->field('zoom_url');
            $show->field('repeat');
            $show->field('order_no');
            $show->field('transaction_id');
            $show->field('pay_code');
            $show->field('pay_time');
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
        return Form::make(new CourseReservation(), function (Form $form) {
            $form->display('id');
            $form->display('email');
            $form->display('phone');
            $form->display('pay_price');
            $form->text('zoom_url')->required();
            $form->display('repeat');
            $form->display('order_no');
            $form->display('transaction_id');
            $form->display('pay_code');
            $form->display('pay_time');
            $form->display('created_at');
            $form->display('updated_at');

            // 隐藏删除按钮
            $form->disableDeleteButton();

            // 保存后钩子
            $form->saved(function (Form $form) {
                $model = $form->model();
                if (!empty($model->zoom_url)) {
                    static::setEmailConfig();
                    Mail::to($model->email)
                    ->queue(new ZoomUrlNotificationMail($model,ConfigSite::getConfig())            
                );
                }
            });
        });
    }
}
