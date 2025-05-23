<?php

namespace App\Admin\Controllers;

use App\Models\CoursePracticeTopic;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Illuminate\Http\Request;

class CoursePracticeTopicController extends AdminController
{
    protected $title = '课程联系留言';
    protected function grid()
    {
        return Grid::make(CoursePracticeTopic::with('topic'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('practice_id', 'Practice ID')->sortable();
            $grid->column('name', 'Name');
            $grid->column('email', 'Email');
            $grid->column('website', 'Website');
            $grid->column('content', 'Content')->limit(50);
            $grid->column('is_show', '是否展示')->options()->select([0 => '否', 1 => '是']);
            $grid->column('topic.content', '回复内容')->limit(50);
            $grid->column('created_at', '留言时间')->sortable();

            // 新增一列显示回复按钮
            $grid->column('reply_action', '回复')->display(function () {
                return '<button type="button" class="btn btn-sm btn-primary reply-btn" data-id="'.$this->id.'">回复</button>';
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('practice_id', 'Practice ID');
                $filter->like('name', 'Name');
                $filter->like('email', 'Email');
                $filter->equal('is_show', '是否展示')->select([0 => '否', 1 => '是']);
                $filter->between('created_at', '留言时间')->datetime();
            });

            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableBatchDelete();
            $grid->model()
            ->where('topic_id',0)
            ->orderBy('id', 'desc');

            $grid->footer(function () {
                return <<<HTML
<!-- 回复弹窗 -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel">
  <div class="modal-dialog" role="document">
    <form id="replyForm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="replyModalLabel">回复留言</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="topic_id" id="reply_topic_id" value="">
          <div class="form-group">
            <label for="reply_content">回复内容</label>
            <textarea class="form-control" name="reply_content" id="reply_content" rows="4" required></textarea>
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
    $('.reply-btn').on('click', function () {
        $('#reply_topic_id').val($(this).data('id'));
        $('#reply_content').val('');
        $('#replyModal').modal('show');
    });
    // 提交表单
    $('#replyForm').on('submit', function (e) {
        e.preventDefault();
        var topic_id = $('#reply_topic_id').val();
        var content = $('#reply_content').val();
        Dcat.loading();
        $.ajax({
            url: '/admin/course-practice-topic/reply',
            type: 'POST',
            data: {
                topic_id: topic_id,
                content: content,
                _token: Dcat.token
            },
            success: function (res) {
                Dcat.loading(false);
                if(res.status) {
                    Dcat.success(res.message);
                    $('#replyModal').modal('hide');
                    location.reload();
                } else {
                    Dcat.error(res.message || '回复失败');
                }
            }
        });
    });
});
</script>
HTML;
            });
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

    public function reply(Request $request)
    {
        $topic = CoursePracticeTopic::find($request->topic_id);
        if (!$topic) {
            return ['status' => 0, 'message' => '留言不存在'];
        }
        CoursePracticeTopic::updateOrCreate([
            'topic_id' => $topic->id,
        ],[
            'practice_id' => $topic->practice_id,
            'name' => "Elena Mandarin",
            'email' => $topic->email,
            'website' => $topic->website,
            'content' => $request->content,
            'is_show' => 1,
        ]);
        return ['status' => 1, 'message' => '回复成功'];
    }
}