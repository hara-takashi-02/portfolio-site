<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\HistorysController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function(){
    //Route::resource('/', 'App\Http\Controllers\WorksController');
    //Route::resource('home', 'App\Http\Controllers\WorksController');
    //Route::resource('task', 'App\Http\Controllers\TaskController');
    Route::resource('work', 'App\Http\Controllers\WorksController');
    Route::resource('skill', 'App\Http\Controllers\SkillsController');
    Route::resource('product', 'App\Http\Controllers\ProductsController');
    Route::resource('profile', 'App\Http\Controllers\ProfilesController');
    Route::resource('history', 'App\Http\Controllers\HistorysController');
    //Route::put('task', [TaskController::class, 'save'])->name('task.save');
    Route::put('work', [WorksController::class, 'save'])->name('work.save');
    Route::put('skill', [SkillsController::class, 'save'])->name('skill.save');
    Route::put('product', [ProductsController::class, 'save'])->name('product.save');
    Route::put('profile', [ProfilesController::class, 'save'])->name('profile.save');
    Route::put('history', [HistorysController::class, 'save'])->name('history.save');

    //Route::get('work', [WorksController::class, 'test'])->name('work.test');

});