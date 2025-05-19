<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;
use App\Admin\Controllers\CoursePracticeTopicController;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    
    $router->resource('course_reservation', 'CourseReservationController')->only(['show','index','destroy','edit','update']);
    $router->resource('config/pay', 'ConfigPayController');   
    $router->resource('config/email', 'ConfigEmailController');
    $router->get('feedback/subscribes', 'SubscribeController@index');
    $router->get('feedback/contact-records', 'ContactRecordController@index');
    $router->resource('config/site', 'ConfigSiteController');
    $router->resource('course-practice', 'CoursePracticeController');
    $router->resource('course-lesson', 'CourseLessonController');
    $router->resource('course-practice-topic', 'CoursePracticeTopicController');
    $router->resource('course-practice-order', 'CoursePracticeOrderController')->only(['index','show']);
    $router->resource('recorded-lesson', 'RecordedLessonController');
});
