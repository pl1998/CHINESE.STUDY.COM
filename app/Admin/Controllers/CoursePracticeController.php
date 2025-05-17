<?php

namespace App\Admin\Controllers;

use App\Models\CoursePractice;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;
class CoursePracticeController extends AdminController
{

    protected $title = '课程练习';

    protected function grid()
    {
        return Grid::make(new CoursePractice(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('level_label', '课程等级标签');
            $grid->column('name', '课程名称');
            $grid->column('zh_name', '课程中文名称');
            $grid->column('level', '难度等级')->display(function($level){
                return CoursePractice::LEVEL_OPTIONS[$level];
            });
            // $grid->column('link', '课程链接')->link();
            $grid->column('audio', '课程语音')->display(function($audio){
                return $audio ? "<audio src='{$audio}' controls></audio>" : '';
            });
            $grid->column('cover', '课程封面')->image('', 100, 60);
            $grid->column('price', '课程价格');
            $grid->column('origin_price', '原价');
            $grid->column('created_at');
            $grid->column('updated_at');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name');
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
        return Show::make($id, new CoursePractice(), function (Show $show) {
            $show->field('id');
            $show->field('level_label', '课程等级标签');
            $show->field('name', '课程名称');
            $show->field('zh_name', '课程中文名称');
            // $show->field('link', '课程链接')->link();
            // $show->field('audio', '课程语音')->display(function($audio){
            //     return $audio ? "<audio src='{$audio}' controls></audio>" : '';
            // });
            $show->field('cover', '课程封面')->image('', 100, 60);
           
            $show->field('created_at');
            $show->field('updated_at');
        });
    }
    protected function form()
    {
        
        return Form::make(new CoursePractice(), function (Form $form) {
            $form->text('name', '课程名称')->required();
            $form->text('zh_name', '课程中文名称')->required();
            // $form->url('link', '课程链接');
            $form->file('audio', '课程语音mp3')
            ->autoUpload()
            ->disk('public') // 使用 public 磁盘
            ->retainable()
            ->name(function ($file) {
                // 获取扩展名
                $ext = $file->getClientOriginalExtension();
                // 生成日期+随机字符串的文件名
                return 'audio/' . date('Ymd') . '_' . uniqid() . '.' . $ext;
            });
            $form->select('level_label', '课程等级标签')->options(CoursePractice::ALL_HSK);
            $form->select('level', '难度等级')->options(CoursePractice::LEVEL_OPTIONS);
            $form->editor('content', '课程描述（富文本）')->options(['height' => 400, 'lang' => 'zh-CN']);
            $form->decimal('price', '课程价格')->default(0);
            $form->decimal('origin_price', '原价')->default(0);
        $form->image('cover', '课程封面')
            ->autoUpload()
            ->retainable()
            ->disk('public') // 使用 public 磁盘
            ->name(function ($file) {
                $ext = $file->getClientOriginalExtension();
                return 'cover/' . date('Ymd') . '_' . uniqid() . '.' . $ext;
            });
        });
      
    }
}