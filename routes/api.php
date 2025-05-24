<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CoursePracticeController;
use App\Http\Controllers\Api\CoursePracticeTopicController;
use App\Http\Controllers\Api\PracticePayController;
use App\Http\Controllers\Api\RecordedLessonController;
use App\Http\Controllers\Api\CourseReservationController;
use App\Http\Controllers\Api\CalendarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/course-reservation', [CourseReservationController::class, 'store']);
Route::post('/paypal/pay', [\App\Http\Controllers\Api\PaypalController::class, 'pay']);
Route::post('/subscribe', [App\Http\Controllers\SubscribeController::class, 'store']);
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store']);
Route::get('course-practices', [CoursePracticeController::class, 'index']);
Route::post('/course_practice_topic', [CoursePracticeTopicController::class, 'store']);
Route::post('/practice/paypal', [PracticePayController::class, 'paypal']);
Route::get('/recorded-lessons', [RecordedLessonController::class, 'index']);
Route::post('/course-reservation/purchase-course-packages', [CourseReservationController::class, 'purchaseoursepackages']);
Route::get('/calendar-data', [CalendarController::class, 'getCalendarData']);
Route::get('/time-slots', [CalendarController::class, 'getTimeSlots']);