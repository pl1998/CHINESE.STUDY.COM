<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CourseReservation;
use App\Http\Traits\EmailConfig;
use App\Models\CourseReservationDate;
use DB;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use App\Mail\ZoomUrlNotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ConfigSite;
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
            $grid->column('full_name', '姓名')->display(function () {
                return ($this->fisrt_name ?? '') . ' ' . ($this->last_name ?? '');
            });
            $grid->column('course_type', '课程类型')->using(\App\Models\CourseReservation::COURSE_TYPE_MAPS);
            $grid->column('email'); 
            $grid->column('pay_status', '支付状态')->using(\App\Models\CourseReservation::PAY_STATUS_MAPS);
          
            $grid->column('status', '状态')->using([
                0 => '未开始',
                1 => '已填充zoom地址',
                2 => '结束',
            ]);
            $grid->column('phone');
            $grid->column('pay_price');
            $grid->column('repeat');
            $grid->column('order_no');
            $grid->column('pay_time');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            // $grid->setActionClass(Grid\Displayers\Actions::class); // 行操作按钮显示方式 图标方式
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                // Disable edit button for unpaid orders
                if ($this->pay_status == 0) {
                    $actions->disableEdit();
                }
                if ($this->pay_status == 1) {
                    $actions->disableDelete();
                    // Add refund button for paid orders
                    $actions->append('<a href="javascript:void(0);" class="grid-row-refund" data-id="'.$this->id.'" data-email="'.$this->email.'" data-amount="'.$this->pay_price.'">
                        <i class="fa fa-undo"></i> 退款
                    </a>');
                    
                    // Add zoom_url button for paid and not started orders
                    // if ($this->status == 0) {
                    //     $actions->append('<a href="javascript:void(0);" class="grid-row-zoom" data-id="'.$this->id.'">
                    //         <i class="fa fa-video-camera"></i> 填写Zoom链接
                    //     </a>');
                    // }
                }
            });

            // Add refund button JavaScript
            Admin::script(<<<JS
                $('.grid-row-refund').on('click', function () {
                    var id = $(this).data('id');
                    var email = $(this).data('email');
                    var amount = $(this).data('amount');
                    
                    Dcat.confirm('确定要对此订单进行退款吗？<br>订单号ID：' + id + '<br>邮箱：' + email + '<br>金额：' + amount, null, function () {
                        // 发送退款请求
                        $.ajax({
                            method: 'POST',
                            url: '/admin/course-reservations/' + id + '/refund',
                            data: {
                                _token: Dcat.token,
                            },
                            success: function (data) {
                                Dcat.success('退款成功');
                                Dcat.reload();
                            },
                            error: function (request) {
                                Dcat.error('退款失败');
                            }
                        });
                    });
                });
            JS);

            $grid->footer(function () {
                return <<<HTML
<!-- Zoom链接填写弹窗 -->
<div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel">
  <div class="modal-dialog" role="document">
    <form id="zoomForm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="zoomModalLabel">填写Zoom链接</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="zoom_id" value="">
          <div class="form-group">
            <label for="zoom_url">Zoom链接</label>
            <input type="text" class="form-control" name="zoom_url" id="zoom_url" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">提交</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
Dcat.ready(function () {
    // 打开弹窗
    $('.grid-row-zoom').on('click', function () {
        var id = $(this).data('id');
        $('#zoom_id').val(id);
        $('#zoom_url').val('');
        $('#zoomModal').modal('show');
    });
    
    // 提交表单
    $('#zoomForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#zoom_id').val();
        var zoom_url = $('#zoom_url').val();
        
        Dcat.loading();
        $.ajax({
            url: '/admin/course-reservations/' + id + '/update-zoom',
            type: 'POST',
            data: {
                zoom_url: zoom_url,
                _token: Dcat.token
            },
            success: function (res) {
                Dcat.loading(false);
                if(res.status) {
                    Dcat.success(res.message);
                    $('#zoomModal').modal('hide');
                    location.reload();
                } else {
                    Dcat.error(res.message || '更新失败');
                }
            }
        });
    });
});
</script>
HTML;
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
                $filter->in('course_type','课程类型')->multipleSelect([
                    '0' => '预约每周课程',
                    '1' => '试听课',
                    '2' => '课程包（6节）',
                ])->width(width: 2);
              
            });
            $grid->disableCreateButton();
            $grid->disableViewButton();
            $grid->disableEditButton();
            $grid->showFilter();
            $grid->model()->orderBy('id', 'desc');
        
            // Fix ID and course type columns
            $grid->fixColumns(2);
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

    /**
     * Handle refund action
     */
    public function refund($id)
    {
        DB::transaction(function() use($id) {
            $reservation = \App\Models\CourseReservation::where('id',$id)->first();
            $reservation->pay_status = 3; // 设置为退款状态
            $reservation->save();
            CourseReservationDate::where('appoint_id',$reservation->id)->update([
                'is_cancel' =>1
            ]);
        });
        return response()->json(['status' => true]);
    }

    /**
     * Edit zoom URL
     */
    public function editZoom($id)
    {
        $reservation = \App\Models\CourseReservation::findOrFail($id);
        
        // Check if the reservation is eligible for zoom URL editing
        if ($reservation->pay_status != 1 || $reservation->status != 0) {
            return response()->json(['status' => false, 'message' => '该订单不符合填写Zoom链接的条件']);
        }

        $form = new \Dcat\Admin\Widgets\Form();
        $form->action(admin_url('course-reservations/'.$id.'/update-zoom'));
        $form->text('zoom_url', 'Zoom链接')->required()->value($reservation->zoom_url);
        
        return $form;
    }

    /**
     * Update zoom URL
     */
    public function updateZoom($id)
    {
        $reservation = \App\Models\CourseReservation::with('courseLesson')->findOrFail($id);
        
        // Check if the reservation is eligible for zoom URL editing
        if ($reservation->pay_status != 1 || $reservation->status != 0) {
            return response()->json(['status' => false, 'message' => '该订单不符合填写Zoom链接的条件']);
        }

        $zoom_url = request('zoom_url');
        if (empty($zoom_url)) {
            return response()->json(['status' => false, 'message' => 'Zoom链接不能为空']);
        }

        $reservation->zoom_url = $zoom_url;
        $reservation->status = 1; // 更新状态为已填充zoom地址
        $reservation->save();

        CourseReservationDate::where('appoint_id',$reservation->id)->update([
            'zoom_url' =>$zoom_url
        ]);
        static::setEmailConfig();
        Mail::to($reservation->email)
        ->queue(new ZoomUrlNotificationMail($reservation,ConfigSite::getConfig()));      

        return response()->json(['status' => true, 'message' => 'Zoom链接更新成功']);
    }
}
