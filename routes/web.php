<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/lessons', function () {
    return Inertia::render('Lessons');
});

Route::get('/recorded', function () {
    return Inertia::render('RecordedLesson');
});

Route::get('/practice', function () {
    return Inertia::render('Practice');
});

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::get('/hsk-lesson', function () {
    return Inertia::render('HskLesson');
});

Route::get('/survival-chinese', function () {
    return Inertia::render('SurvivalChinese');
});

Route::get('/debate-topics', function () {
    return Inertia::render('DebateTopics');
});

Route::get('/conversational-chinese', function () {
    return Inertia::render('ConversationalChinese');
});

Route::get('/courses/{type}', function ($type) {
    return Inertia::render('Course', ['type' => $type]);
});

