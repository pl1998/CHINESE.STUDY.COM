<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    
    $router->resource('/course_reservation', 'CourseReservationController')->only(['show','index','destroy','edit','update']);
    $router->resource('config/pay', 'ConfigPayController');   
    $router->resource('config/email', 'ConfigEmailController');

});
