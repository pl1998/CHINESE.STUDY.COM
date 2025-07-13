<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\PaypalController;
use App\Http\Controllers\InertiaController;
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

Route::middleware(['block.china'])->group(function () {
    Route::get('/', [InertiaController::class, 'index']);

    Route::get('/lessons', [InertiaController::class, 'lessons']);
    
    Route::get('/recorded', [InertiaController::class, 'recorded']);
    
    Route::get('/practice/{level}', [InertiaController::class, 'practice']);
    
    Route::get('/about', [InertiaController::class, 'about']);
    
    Route::get('/contact', [InertiaController::class, 'contact']);
    
    Route::get('/hsk-lesson/{id}', [InertiaController::class, 'hskLesson']);
    
    Route::get('/survival-chinese', [InertiaController::class, 'survivalChinese']);
    
    Route::get('/debate-topics', [InertiaController::class, 'debateTopics']);
    
    Route::get('/conversational-chinese', [InertiaController::class, 'conversationalChinese']);
    
    Route::get('/courses/{type}', [InertiaController::class, 'courses']);
    
    Route::get('/paypal/success', [PaypalController::class, 'success']);
    
    Route::get('/paypal/cancel', [PaypalController::class, 'cancel']);
    
    Route::get('/practice-detail/{id}', [InertiaController::class, 'practiceDetail']);
});
