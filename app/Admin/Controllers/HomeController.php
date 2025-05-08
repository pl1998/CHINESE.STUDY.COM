<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Linkbox;
use Dcat\Admin\Widgets\MediaList;
use Dcat\Admin\Widgets\Callout;
use Dcat\Admin\Widgets\Alert;
use Dcat\Admin\Widgets\ListGroup;
use Dcat\Admin\Widgets\InfoList;
use Dcat\Admin\Widgets\CoverCard;

class HomeController extends Controller
{
    public function index(Content $content)
        {

            $alert = Alert::make('<h1>Hi !管理员</h1>');
            $content =  $content
                ->header('ELENA MANDARIN')
                ->description('')
                ->row($alert->info())
                // ->row(function (Row $row) {
                //     $row->column(9, function (Column $column) {
                //         $yue = date('m');
                //         $events_list = [
                //             [
                //                 'title' => '今天的事项',
                //                 'start' => '2024-'.$yue.'-01 14:00:00', // 示例日期，您可以根据需要替换
                //                 'backgroundColor' => '#f56954', // red
                //                 'borderColor' => '#f56954', // red
                //                 'allDay' => false, // 指示事件是否为全天事件。默认为 false
                //                 'description' => '这是今天的事项描述', // 描述信息
                //                 'showModal' => true,
                //             ],
                //             [
                //                 'title' => '长事项',
                //                 'start' => '2024-'.$yue.'-27 00:00:00', // 示例日期，您可以根据需要替换
                //                 'end' => '2024-'.$yue.'-30 00:00:00', // 示例日期，您可以根据需要替换
                //                 'backgroundColor' => '#f39c12', // yellow
                //                 'borderColor' => '#f39c12', // yellow
                //                 'description' => '长事项描述', // 描述信息
                //                 'showModal' => true,
                //             ],
                //             [
                //                 'title' => 'Meeting 11111',
                //                 'start' => '2024-'.$yue.'-02 10:30:00', // 示例日期，您可以根据需要替换
                //                 'allDay' => false,
                //                 'backgroundColor' => '#0073b7', // Blue
                //                 'borderColor' => '#0073b7', // Blue
                //             ],
                //             [
                //                 'title' => 'Lunch 2222',
                //                 'start' => '2024-'.$yue.'-02 12:00:00', // 示例日期，您可以根据需要替换
                //                 'end' => '2024-'.$yue.'-02 14:00:00', // 示例日期，您可以根据需要替换
                //                 'allDay' => false,
                //                 'backgroundColor' => '#00c0ef', // Info (aqua)
                //                 'borderColor' => '#00c0ef', // Info (aqua)
                //             ],
                //             [
                //                 'title' => 'Birthday Party',
                //                 'start' => '2024-'.$yue.'-03 19:00:00', // 示例日期，您可以根据需要替换
                //                 'end' => '2024-'.$yue.'-03 22:30:00', // 示例日期，您可以根据需要替换
                //                 'allDay' => false,
                //                 'backgroundColor' => '#00a65a', // Success (green)
                //                 'borderColor' => '#00a65a', // Success (green)
                //             ],
                //             [
                //                 'title' => 'Click for baidu',
                //                 'start' => '2024-'.$yue.'-28 00:00:00', // 示例日期，您可以根据需要替换
                //                 'end' => '2024-'.$yue.'-29 00:00:00', // 示例日期，您可以根据需要替换
                //                 'url' => 'https://www.baidu.com/',
                //                 'backgroundColor' => '#3c8dbc', // Primary (light-blue)
                //                 'borderColor' => '#3c8dbc', // Primary (light-blue)
                //             ],
                //         ];
                //         $calendar = \Dcat\Admin\Widgets\Calendar::make();
                //         $calendar->eventItem($events_list);
                //         $Card = Card::make($calendar->render());
                //         $column->row($Card->render());
                //     });
                //     $row->column(3, function (Column $column) {

                      
                //         $group = ListGroup::make();

                //         // 获取已安装扩展包信息
                //         $installedPackages = json_decode(file_get_contents(base_path('vendor/composer/installed.json')), true);

                //         // 指定要获取版本号的扩展包名称
                //         $packageName = 'dcat-plus/laravel-admin';

                //         // 查找指定扩展包的版本号
                //         $packageVersion = '--';
                //         if(!empty($installedPackages['packages'])){
                //             foreach ($installedPackages['packages'] as $package) {
                //                 if ($package['name'] === $packageName) {
                //                     $packageVersion = $package['version'];
                //                     break;
                //                 }
                //             }
                //         }
                //         //$group->add('这是第5个标题', '这是第5个');
                //         $column->row($group->render());

                //     });
                // })
                ->row(function (Row $row) {
                    $row->column(6, function (Column $column) {
                        // $column->row(Dashboard::author());
                        $column->row(new Examples\Tickets());
                    });

                    $row->column(6, function (Column $column) {

                        $column->row(function (Row $row) {
                            $row->column(6, new Examples\NewUsers());
                            $row->column(6, new Examples\NewDevices());
                        });

                        $column->row(new Examples\Sessions());
                        $column->row(new Examples\ProductOrders());
                    });
                });

            return $content;
        }
}
